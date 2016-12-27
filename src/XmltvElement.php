<?php
namespace XMLTV;

/**
 * XMLTV generator
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
abstract class XmltvElement
{
    /**
     * @var \DomElement
     */
    protected $_xml;

    /**
     * @var \XMLTV\XmltvElement
     */
    protected $parent;

    /**
     * @var array of \XMLTV\XmltvElement
     */
    protected $children;

    const ALLOWED  = 0x01;
    const REQUIRED = 0x02;
    const SINGLE   = 0x04;

    abstract public function getTagName();
    abstract public function getAllowedAttributes();
    abstract public function getAllowedChildren();

    public function __construct($attributes = [], $value_or_callback = null)
    {
        $this->children = [];

        $value    =  is_callable($value_or_callback) ? null : $value_or_callback;
        $callback = !is_callable($value_or_callback) ? null : $value_or_callback;

        $this->_xml = Xmltv::getDocument()->createElement($this->getTagName(), $value);

        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }

        if (!is_null($callback)) {
            $callback($this);
        }
    }

    public function __call($name, $arguments)
    {
        // Attribute setter
        if (strpos($name, 'set') === 0) {
            $called_attribute = substr($name, 3);
            foreach ($this->getAllowedAttributes() as $attribute => $rules) {
                if (ucfirst(strtolower(str_replace('-', '', $attribute))) == $called_attribute) {
                    array_unshift($arguments, $attribute);
                    return call_user_func_array([ $this, 'setAttribute' ], $arguments);
                }
            }
            throw new XmltvException(
                sprintf(
                    XmltvException::UNKNOWN_ATTRIBUTE_ERROR_MESSAGE,
                    get_called_class(),
                    $called_attribute
                ),
                XmltvException::UNKNOWN_ATTRIBUTE_ERROR_CODE
            );
        }
        // Method to add a child
        elseif (strpos($name, 'add') === 0) {
            $called_child = substr($name, 3);
            foreach ($this->getAllowedChildren() as $child => $rules) {
                if (ucfirst(strtolower(str_replace('-', '', $child))) == $called_child) {
                    array_unshift($arguments, $child);
                    return call_user_func_array([ $this, 'addChild' ], $arguments);
                }
            }
            throw new XmltvException(
                sprintf(
                    XmltvException::UNKNOWN_CHILD_ERROR_MESSAGE,
                    get_called_class(),
                    $called_child
                ),
                XmltvException::UNKNOWN_CHILD_ERROR_CODE
            );
        }
        // Unknown method
        else {
            throw new XmltvException(
                sprintf(
                    XmltvException::UNKNOWN_METHOD_ERROR_MESSAGE,
                    get_called_class(),
                    $name
                ),
                XmltvException::UNKNOWN_METHOD_ERROR_CODE
            );
        }
    }

    public function validate()
    {
        $this->attachChildren();

        foreach ($this->children as $child) {
            $child->validate();
        }

        // Check unsupported attributes
        if ($this->_xml->hasAttributes()) {
            foreach ($this->_xml->attributes as $name => $value) {
                if (!in_array($name, array_keys($this->getAllowedAttributes()))) {
                    throw new XmltvException(
                        sprintf(
                            XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE,
                            get_called_class(),
                            $name
                        ),
                        XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
                    );
                }
            }
        }

        // Check missing required attributes
        foreach ($this->getAllowedAttributes() as $name => $rules) {
            if (!$this->_xml->hasAttribute($name) && ($rules & static::REQUIRED)) {
                throw new XmltvException(
                    sprintf(
                        XmltvException::MISSING_ATTRIBUTE_ERROR_MESSAGE,
                        get_called_class(),
                        $name
                    ),
                    XmltvException::MISSING_ATTRIBUTE_ERROR_CODE
                );
            }
        }

        // Check unsupported children
        if (!empty($this->children)) {
            foreach ($this->children as $child) {
                if (!in_array($child->getTagName(), array_keys($this->getAllowedChildren()))) {
                    throw new XmltvException(
                        sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_called_class(), $child->getTagName()),
                        XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
                    );
                }
            }
        }

        // Check missing required children and single children
        foreach ($this->getAllowedChildren() as $name => $rules) {
            $xpath    = new \DOMXPath(Xmltv::getDocument());
            $children = $xpath->query('./'.$name, $this->_xml);
            if ($children->length == 0 && ($rules & static::REQUIRED)) {
                throw new XmltvException(
                    sprintf(XmltvException::MISSING_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                    XmltvException::MISSING_CHILD_ERROR_CODE
                );
            }

            if (count($children) > 1 && ($rules & static::SINGLE)) {
                throw new XmltvException(
                    sprintf(XmltvException::MULTIPLE_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                    XmltvException::MULTIPLE_CHILD_ERROR_CODE
                );
            }
        }

    }

    public function setAttribute($name, $value = null)
    {
        if (!in_array($name, array_keys($this->getAllowedAttributes()))) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
            );
        }

        if ($this->_xml->hasAttribute($name)) {
            throw new XmltvException(
                sprintf(XmltvException::MULTIPLE_ATTRIBUTE_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
            );
        }

        $this->_xml->setAttribute($name, $value);

        return $this;
    }

    public function addChild(string $name, array $attributes = [], $value_or_callback = null)
    {
        $childClass = get_called_class().'\\'.(ucfirst(strtolower(str_replace('-', '', $name))));
        $child      = new $childClass($attributes, $value_or_callback);

        $this->children[] = $child;

        return $this;
    }

    public function appendTo(\DomNode $parent)
    {
        Xmltv::getDocument()->importNode($this->_xml);
        $parent->appendChild($this->_xml);

        $this->parent = $parent;
    }

    public function remove()
    {
        if ($this->parent) {
            $this->parent->removeChild($this->_xml);
        }
    }

    public function toXml()
    {
        $this->attachChildren();
        $this->validate();

        return Xmltv::getDocument()->saveXml($this->_xml);
    }

    protected function attachChildren()
    {
        // Remove all previously attached children, if any
        foreach ($this->children as $child) {
            $child->remove();
        }

        // Sort the children using the allowed children array
        $allowed_children = array_keys($this->getAllowedChildren());
        usort($this->children, function ($a, $b) use ($allowed_children) {
            $index_a = array_search($a->getTagName(), $allowed_children);
            $index_b = array_search($b->getTagName(), $allowed_children);
            return $index_a < $index_b ? -1 : ( $index_a > $index_b ? 1 : 0 );
        });

        // Append the children
        foreach ($this->children as $child) {
            $child->appendTo($this->_xml);
        }

        // Go down, recursively
        foreach ($this->children as $child) {
            $child->attachChildren();
        }
    }
}
