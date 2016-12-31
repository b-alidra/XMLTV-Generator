<?php
namespace XMLTV;

use \XMLTV\XmltvException;

/**
 * XMLTV tv
 *
 * Represents the tv root element in the DTD
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 *
 * @method \XMLTV\XmltvElement setDate(string $value)
 * @method \XMLTV\XmltvElement setSourceinfourl(string $source_info_url)
 * @method \XMLTV\XmltvElement setSourceinfoname(string $source_info_name)
 * @method \XMLTV\XmltvElement setSourceDataUrl(string $source_data_url)
 * @method \XMLTV\XmltvElement setGeneratorinfoname(string $generator_info_name)
 * @method \XMLTV\XmltvElement setGeneratorinfourl(string $generator_info_url)
 * @method \XMLTV\XmltvElement addChannel(array $attributes, string $value, callable $callback)
 * @method \XMLTV\XmltvElement addProgramme(array $attributes, string $value, callable $callback)
 */
class Tv extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'tv';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [
            'date'                => XmltvElement::ALLOWED,
            'source-info-url'     => XmltvElement::ALLOWED,
            'source-info-name'    => XmltvElement::ALLOWED,
            'source-data-url'     => XmltvElement::ALLOWED,
            'generator-info-name' => XmltvElement::ALLOWED,
            'generator-info-url'  => XmltvElement::ALLOWED,
        ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [
            'channel'             => XmltvElement::ALLOWED,
            'programme'           => XmltvElement::ALLOWED
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
