<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program subtitles
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Subtitles extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'subtitles';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [ 'type' => XmltvElement::SINGLE ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [ 'language' => XmltvElement::SINGLE ];
    }

    /**
     * @see \XMLTV\XmltvElement::checkAttributeValue
     */
    public function checkAttributeValue($attribute, $value)
    {
        parent::checkAttributeValue($attribute, $value);

        // Support only teletext, onscreen and deaf-signed values
        if (!in_array($value, ['teletext', 'onscreen', 'deaf-signed'])) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class()),
                XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
            );
        }
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
