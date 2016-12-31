<?php
namespace XMLTV\Tv;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV channel
 *
 * Represents the channel tag in the DTD
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Channel extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'channel';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [ 'id' => XmltvElement::REQUIRED ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [
            'display-name' => XmltvElement::REQUIRED,
            'icon'         => XmltvElement::ALLOWED,
            'url'          => XmltvElement::ALLOWED
        ];
    }

    /**
     * @see \XMLTV\XmltvElement::checkValue
     */
    public function checkValue($value)
    {
        // Do not support any text content
        throw new XmltvException(
            sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class()),
            XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
        );
    }
}
