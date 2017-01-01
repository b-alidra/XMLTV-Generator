<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * XMLTV program new child.
 *
 * Due to his name, this element is handled differently,
 * by adding the Element suffix.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class NewElement extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'new';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [];
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
