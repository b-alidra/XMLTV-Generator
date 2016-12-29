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
     * @var \DomDocument
     */
    protected $_document;

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

    /**
     * Constructor
     *
     * @param \DomDocument $document: The document this element will be attached to
     *
     * @param array $attributes: Array of attributes as $name => $value
     *
     * @param string $value: The element value
     *
     * @param callable $callback: Callback function which receives the new
     *                            created element as argument
     */
    public function __construct(\DomDocument $document, $attributes = [], $value = null, $callback = null)
    {
        $this->children = [];

        $this->_document = $document;
        $this->_xml      = $this->_document->createElement($this->getTagName(), /*see PHP Bug #31191*/null);

        foreach ($attributes as $attr_name => $attr_value) {
            $this->_setAttribute($attr_name, $attr_value);
        }

        if (!empty($value)) {
            $this->_xml->appendChild($this->_document->createTextNode($value));
        }

        if (is_callable($callback)) {
            $callback($this);
        }
    }

    public function appendTo(\DomNode $parent)
    {
        $parent->appendChild($this->_xml);
        $this->parent = $parent;
    }

    public function remove()
    {
        if ($this->parent) {
            $this->parent->removeChild($this->_xml);
            $this->parent = null;
        }
    }

    protected function _setAttribute($name, $value = null)
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

    protected function _addChild(string $name, $args = null)
    {
        $childClass = get_called_class().'\\'.(ucfirst(strtolower(str_replace('-', '', $name))));

        $arguments = func_get_args();
        // remove function name
        array_shift($arguments);

        $attributes = [];
        $value      = null;
        $callback   = null;
        foreach ($arguments as $arg) {
            if (is_array($arg)) {
                $attributes = $arg;
            }
            elseif (is_callable($arg)) {
                $callback = $arg;
            }
            elseif (!is_null($arg)) {
                $value = $arg;
            }
        }

        $reflection = new \ReflectionClass($childClass);
        $child      = $reflection->newInstance($this->_document, $attributes, $value, $callback);

        $this->children[] = $child;

        return $this;
    }

    protected function _attachChildren()
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
            $child->_attachChildren();
        }
    }

    public function validate()
    {
        $this->_attachChildren();

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
            $xpath    = new \DOMXPath($this->_document);
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

    public function __call($name, $arguments)
    {
        // Attribute setter
        if (strpos($name, 'set') === 0) {
            $called_attribute = substr($name, 3);
            foreach ($this->getAllowedAttributes() as $attribute => $rules) {
                if (ucfirst(strtolower(str_replace('-', '', $attribute))) == $called_attribute) {
                    array_unshift($arguments, $attribute);
                    return call_user_func_array([ $this, '_setAttribute' ], $arguments);
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
                    return call_user_func_array([ $this, '_addChild' ], $arguments);
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
}
