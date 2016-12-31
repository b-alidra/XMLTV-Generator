<?php

namespace XMLTV;

/**
 * XMLTV Element.
 *
 * Represents an element in the XMLTV DTD
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

    /**
     * Constants used to define rules for each tag attribute and child.
     */
    const ALLOWED = 0x01;
    const REQUIRED = 0x02;
    const SINGLE = 0x04;

    /**
     * Return the element tag name.
     *
     * @abstract
     *
     * @return string The element tag name
     */
    abstract public function getTagName();

    /**
     * Return the allowed attributes for this element.
     *
     * @return array An array containing allowed attributes.
     *               For each attribute (key), define the presence rules using
     *               ::ALLOWED, ::SINGLE and ::REQUIRED.
     */
    abstract public function getAllowedAttributes();

    /**
     * Return the allowed children for this element.
     *
     * @return array An array containing allowed children.
     *               For each child (key), define the presence rules using
     *               ::ALLOWED, ::SINGLE and ::REQUIRED.
     */
    abstract public function getAllowedChildren();

    /**
     * Check if the provided value (text content #PCDATA)
     * is valid for this element.
     *
     * By default, authorize any string value.
     * Should be overridden for specific cases.
     *
     * @throws \XMLTV\XmltvException if the value is not valid
     */
    public function checkValue($value)
    {
        if (!is_scalar($value)) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class()),
                XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
            );
        }
    }

    /**
     * Check if the provided value is valid for the attribute.
     *
     * By default, authorize any string value for supported attributes.
     * Should be overridden for specific cases.
     *
     * @param string $attribute The attribute to check
     * @param string $value     The value to check
     *
     * @throws \XMLTV\XmltvException if this attribute already exists
     *                               or the value is not valid
     */
    public function checkAttributeValue($attribute, $value)
    {
        if ($this->_xml->hasAttribute($attribute)) {
            throw new XmltvException(
                sprintf(XmltvException::MULTIPLE_ATTRIBUTE_ERROR_MESSAGE, get_called_class(), $attribute),
                XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
            );
        }

        if (!is_scalar($value)) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class(), $attribute),
                XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
            );
        }
    }

    /**
     * Constructor.
     *
     * @param \DomDocument $document   The document this element will be attached to
     * @param array        $attributes Array of attributes as $name => $value
     * @param string       $value      The element value
     * @param callable     $callback   Callback function which receives the new
     *                                 created element as argument
     */
    public function __construct(\DomDocument $document, $attributes = [], $value = null, $callback = null)
    {
        $this->children = [];

        $this->_document = $document;
        $this->_xml = $this->_document->createElement($this->getTagName(), /*see PHP Bug #31191*/null);

        foreach ($attributes as $attr_name => $attr_value) {
            $this->_setAttribute($attr_name, $attr_value);
        }

        if (!empty($value)) {
            $this->_setValue($value);
        }

        if (is_callable($callback)) {
            $callback($this);
        }
    }

    /**
     * Attach this element to a Dom node.
     *
     * @param \DomNode $parent The noe to attach the element to
     */
    public function appendTo(\DomNode $parent)
    {
        $parent->appendChild($this->_xml);
        $this->parent = $parent;
    }

    /**
     * Detach this element from his parent, if any.
     */
    public function remove()
    {
        if ($this->parent) {
            $this->parent->removeChild($this->_xml);
            $this->parent = null;
        }
    }

    /**
     * Set one of this element attributes.
     *
     * @param string $name  The attribute name
     * @param string $value The attribute value
     *
     * @throws \XMLTV\XmltvException if the attribute already exists
     *
     * @return \XMLTV\XmltvElement
     */
    protected function _setAttribute($name, $value = null)
    {
        $this->checkAttributeValue($name, $value);
        $this->_xml->setAttribute($name, $value);

        return $this;
    }

    /**
     * Set this element text value.
     *
     * @param string $value The text value
     *
     * @throws \XMLTV\XmltvException if the value is not valid
     *
     * @return \XMLTV\XmltvElement
     */
    protected function _setValue($value)
    {
        $this->checkValue($value);
        $this->_xml->appendChild($this->_document->createTextNode($value));

        return $this;
    }

    /**
     * Add a child to this element.
     *
     * @param string $name The child tag name
     * @param mixed  $args The child attributes and/or value and/or callback function
     *
     * @return \XMLTV\XmltvElement
     */
    protected function _addChild($name, $args = null)
    {
        $childClass = get_called_class().'\\'.(ucfirst(strtolower(str_replace('-', '', $name))));

        $arguments = func_get_args();
        // remove function name
        array_shift($arguments);

        $attributes = [];
        $value = null;
        $callback = null;
        foreach ($arguments as $arg) {
            if (is_array($arg)) {
                $attributes = $arg;
            } elseif (is_callable($arg)) {
                $callback = $arg;
            } elseif (!is_null($arg)) {
                $value = $arg;
            }
        }

        $reflection = new \ReflectionClass($childClass);
        $child = $reflection->newInstance($this->_document, $attributes, $value, $callback);

        $this->children[] = $child;

        return $this;
    }

    /**
     * Attach all this element children.
     */
    protected function _attachChildren()
    {
        // Remove all previously attached children, if any
        if (empty($this->children)) {
            return false;
        }

        foreach ($this->children as $child) {
            $child->remove();
        }

        // Sort the children using the allowed children array
        $allowed_children = array_keys($this->getAllowedChildren());
        usort($this->children, function ($a, $b) use ($allowed_children) {
            $index_a = array_search($a->getTagName(), $allowed_children);
            $index_b = array_search($b->getTagName(), $allowed_children);

            return $index_a < $index_b ? -1 : ($index_a > $index_b ? 1 : 0);
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

    /**
     * Call the internal validation.
     *
     * @throws \XMLTV\XmltvException if the validation fails
     */
    public function validate()
    {
        $this->_attachChildren();

        if (!empty($this->children)) {
            foreach ($this->children as $child) {
                $child->validate();
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

        // Check missing required children and single children
        foreach ($this->getAllowedChildren() as $name => $rules) {
            $xpath = new \DOMXPath($this->_document);
            $children = $xpath->query('./'.$name, $this->_xml);
            if ($children->length == 0 && ($rules & static::REQUIRED)) {
                throw new XmltvException(
                    sprintf(XmltvException::MISSING_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                    XmltvException::MISSING_CHILD_ERROR_CODE
                );
            }

            if ($children->length > 1 && ($rules & static::SINGLE)) {
                throw new XmltvException(
                    sprintf(XmltvException::MULTIPLE_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                    XmltvException::MULTIPLE_CHILD_ERROR_CODE
                );
            }
        }
    }

    /**
     * Magic method to handle add* and set* calls.
     *
     * Attributes setters are in the following form:
     *  set[ucfirst(strtolower(str_replace('-', '', $attribute_name))]($value)
     *
     * Children setters are in the following form:
     *  add[ucfirst(strtolower(str_replace('-', '', $child_tag_name))]($args)
     *
     * @throws \XMLTV\XmltvException if the call is not in a valid form
     */
    public function __call($name, $arguments)
    {
        // Attribute setter
        if (strpos($name, 'set') === 0) {
            $called_attribute = substr($name, 3);
            foreach ($this->getAllowedAttributes() as $attribute => $rules) {
                if (ucfirst(strtolower(str_replace('-', '', $attribute))) == $called_attribute) {
                    array_unshift($arguments, $attribute);

                    return call_user_func_array([$this, '_setAttribute'], $arguments);
                }
            }
            throw new XmltvException(
                sprintf(
                    XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE,
                    get_called_class(),
                    $called_attribute
                ),
                XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
            );
        }
        // Method to add a child
        elseif (strpos($name, 'add') === 0) {
            $called_child = substr($name, 3);
            foreach ($this->getAllowedChildren() as $child => $rules) {
                if (ucfirst(strtolower(str_replace('-', '', $child))) == $called_child) {
                    array_unshift($arguments, $child);

                    return call_user_func_array([$this, '_addChild'], $arguments);
                }
            }
            throw new XmltvException(
                sprintf(
                    XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE,
                    get_called_class(),
                    $called_child
                ),
                XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
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
