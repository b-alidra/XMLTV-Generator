<?php

namespace XMLTV\Tv\Channel;

use XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * XMLTV channel icon.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Icon extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'icon';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [
            'src'    => XmltvElement::REQUIRED,
            'width'  => XmltvElement::SINGLE,
            'height' => XmltvElement::SINGLE,
        ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
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
