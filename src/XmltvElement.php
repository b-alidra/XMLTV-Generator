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
    protected $_xml;

    const ALLOWED  = 0x01;
    const REQUIRED = 0x02;
    const SINGLE   = 0x04;

    abstract public function getTagName();
    abstract public function getAllowedAttributes();
    abstract public function getAllowedChildren();

    public function __construct($attributes = [], $children = [])
    {
        $this->_xml = new \SimpleXMLElement('<'.$this->getTagName().' />');

        foreach ($attributes as $name => $value) {
            $this->addAttribute($name, $value);
        }
        foreach ($children as $name => $value) {
            $this->addChild($name, $value);
        }
    }

    public function validate()
    {
        foreach ($this->_xml->attributes() as $name => $value) {
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

        foreach ($this->getAllowedAttributes() as $name => $rules) {
            if (empty($this->_xml[$name]) && ($rules & static::REQUIRED)) {
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

        foreach ($this->_xml->children() as $name => $value) {
            if (!in_array($name, array_keys($this->getAllowedChildren()))) {
                throw new XmltvException(
                    sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                    XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
                );
            }
        }

        foreach ($this->getAllowedChildren() as $name => $rules) {
            $children = $this->_xml->xpath('/'.$this->getTagName().'/'.$name);
            if (empty($children) && ($rules & static::REQUIRED)) {
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

    public function getXml() { return $this->_xml; }

    public function addChild($name, $value = null)
    {
        if (!in_array($name, array_keys($this->getAllowedChildren()))) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
            );
        }

        $this->_xml->addChild($name, XmltvElement::sanitize($value));

        return $this;
    }

    public function addAttribute($name, $value = null)
    {
        if (!in_array($name, array_keys($this->getAllowedAttributes()))) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
            );
        }

        if (isset($this->_xml[$name])) {
            throw new XmltvException(
                sprintf(XmltvException::MULTIPLE_ATTRIBUTE_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
            );
        }

        $this->_xml->addAttribute($name, XmltvElement::sanitize($value));

        return $this;
    }

    public static function merge(\SimpleXMLElement $parent, \SimpleXMLElement $child)
    {
        $added = $parent->addChild($child->getName(), (string)$child);

        foreach($child->attributes() as $name => $value) {
            $added->addAttribute($name, $value);
        }

        foreach($child->children() as $grand_child) {
            static::merge($added, $grand_child);
        }

        return $parent;
    }

    public static function sanitize($string)
    {
        return str_replace('&', 'amp;', $string);
    }
}
