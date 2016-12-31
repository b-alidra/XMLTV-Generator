<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program star rating
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Starrating extends XmltvElement
{
    public function getTagName()
    {
        return 'star-rating';
    }

    public function getAllowedAttributes()
    {
        return [ 'system' => XmltvElement::SINGLE ];
    }

    public function getAllowedChildren()
    {
        return [
            'value' => XmltvElement::REQUIRED,
            'icon'  => XmltvElement::ALLOWED
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
