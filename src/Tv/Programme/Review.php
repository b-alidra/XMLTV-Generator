<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * XMLTV program review.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Review extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'review';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [
            'type'     => XmltvElement::REQUIRED,
            'source'   => XmltvElement::SINGLE,
            'reviewer' => XmltvElement::SINGLE,
            'lang'     => XmltvElement::SINGLE,
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
     * @see \XMLTV\XmltvElement::checkAttributeValue
     */
    public function checkAttributeValue($attribute, $value)
    {
        parent::checkAttributeValue($attribute, $value);

        // Support only text and url values
        if ($attribute == 'type' && !in_array($value, ['text', 'url'])) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class(), $value),
                XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
            );
        }
    }
}
