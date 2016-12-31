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
    public function getTagName()
    {
        return 'subtitles';
    }

    public function getAllowedAttributes()
    {
        return [
            'type'             => XmltvElement::SINGLE
        ];
    }

    public function getAllowedChildren()
    {
        return [ 'language' => XmltvElement::SINGLE ];
    }

    /**
     * @see \XMLTV\XmltvElement::check_attribute_value
     */
    public function checkAttributeValue($attribute, $value)
    {
        parent::checkAttributeValue($attribute, $value);

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
