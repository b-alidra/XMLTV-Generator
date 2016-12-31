<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program previously shown
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Previouslyshown extends XmltvElement
{
    public function getTagName()
    {
        return 'previously-shown';
    }

    public function getAllowedAttributes()
    {
        return [
            'start'   => XmltvElement::ALLOWED,
            'channel' => XmltvElement::ALLOWED
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
