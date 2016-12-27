<?php
namespace XMLTV;

/**
 * XMLTV tv
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Tv extends XmltvElement
{
    public function getTagName()
    {
        return 'tv';
    }

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

    public function getAllowedChildren()
    {
        return [
            'channel'             => XmltvElement::ALLOWED,
            'programme'             => XmltvElement::ALLOWED
        ];
    }
}
