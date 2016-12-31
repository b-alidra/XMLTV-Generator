<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;
use \XMLTV\XmltvException;

/**
 * XMLTV program length
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Length extends XmltvElement
{
    public function getTagName()
    {
        return 'length';
    }

    public function getAllowedAttributes()
    {
        return [ 'units' => XmltvElement::REQUIRED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }

    /**
     * @see \XMLTV\XmltvElement::check_attribute_value
     */
    public function checkAttributeValue($attribute, $value)
    {
        parent::checkAttributeValue($attribute, $value);

        // Do not support any text content
        if (!in_array($value, ['seconds', 'minutes', 'hours'])) {
            throw new XmltvException(
                sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class(), $value),
                XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
            );
        }
    }
}
