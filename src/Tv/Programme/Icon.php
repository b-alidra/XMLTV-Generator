<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * XMLTV program icon
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Icon extends XmltvElement
{
    public function getTagName()
    {
        return 'icon';
    }

    public function getAllowedAttributes()
    {
        return [
            'src'    => XmltvElement::REQUIRED,
            'width'  => XmltvElement::SINGLE,
            'height' => XmltvElement::SINGLE,
        ];
    }

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
