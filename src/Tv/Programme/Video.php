<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program video
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Video extends XmltvElement
{
    public function getTagName()
    {
        return 'video';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [
            'present' => XmltvElement::SINGLE,
            'colour'  => XmltvElement::SINGLE,
            'aspect'  => XmltvElement::SINGLE,
            'quality' => XmltvElement::SINGLE
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
