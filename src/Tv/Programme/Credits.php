<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program credits
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Credits extends XmltvElement
{
    public function getTagName()
    {
        return 'credits';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [
            'director'    => XmltvElement::ALLOWED,
            'actor'       => XmltvElement::ALLOWED,
            'writer'      => XmltvElement::ALLOWED,
            'adapter'     => XmltvElement::ALLOWED,
            'producer'    => XmltvElement::ALLOWED,
            'composer'    => XmltvElement::ALLOWED,
            'editor'      => XmltvElement::ALLOWED,
            'presenter'   => XmltvElement::ALLOWED,
            'commentator' => XmltvElement::ALLOWED,
            'guest'       => XmltvElement::ALLOWED,
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
