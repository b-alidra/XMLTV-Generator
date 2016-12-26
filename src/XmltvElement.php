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
     * @var DomDocument
     */
    protected static $document;

    /**
     * @var \DomElement
     */
    protected $_xml;

    const ALLOWED  = 0x01;
    const REQUIRED = 0x02;
    const SINGLE   = 0x04;

    abstract public function getTagName();
    abstract public function getAllowedAttributes();
    abstract public function getAllowedChildren();

    public function __construct($attributes = [], $value = null)
    {
        $this->_xml = static::getDocument()->createElement($this->getTagName(), $value);

        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }
    }

    public function __call($name, $arguments)
    {
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

        if ($this->_xml->hasChildNodes()) {
            foreach ($this->_xml->childNodes as $child) {
                if (!in_array($child->nodeName, array_keys($this->getAllowedChildren()))) {
                    throw new XmltvException(
                        sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                        XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
                    );
                }
            }
        }

        foreach ($this->getAllowedChildren() as $name => $rules) {
            $xpath    = new \DOMXPath(static::getDocument());
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

    public static function getDocument()
    {
        if (is_null(static::$document)) {
            $implementation = new \DOMImplementation();
            $dtd            = $implementation->createDocumentType('tv', 'SYSTEM', 'http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd');
            static::$document = $implementation->createDocument('', '', $dtd);

            static::$document->encoding           = 'UTF-8';
            static::$document->preserveWhiteSpace = false;
            static::$document->formatOutput       = true;
        }

        return static::$document;
    }

    public function getXml() { return $this->_xml; }

    public function addChild(string $name, array $attributes = [], $value_or_callback = null)
    {
        if (!in_array($name, array_keys($this->getAllowedChildren()))) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_called_class(), $name),
                XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
            );
        }

        $value    =  is_callable($value_or_callback) ? null : $value_or_callback;
        $callback = !is_callable($value_or_callback) ? null : $value_or_callback;

        $childClass = get_called_class().'\\'.(ucfirst(strtolower(str_replace('-', '', $name))));
        $child      = new $childClass($attributes, $value);

        if (!is_null($callback)) {
            $callback($child);
        }
        static::getDocument()->importNode($child->getXml());
        $this->_xml->appendChild($child->getXml());

        return $this;
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

        $this->_xml->setAttribute($name, XmltvElement::sanitize($value));

        return $this;
    }

    public static function sanitize($string)
    {
        return str_replace('&', 'amp;', $string);
    }
}
