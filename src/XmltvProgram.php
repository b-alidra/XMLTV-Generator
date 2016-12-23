<?php
namespace XMLTV;

/**
 * XMLTV program
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class XmltvProgram extends XmltvElement
{
    public function getTagName()
    {
        return 'programme';
    }

    public function getAllowedAttributes()
    {
        return [
            'channel'          => XmltvElement::SINGLE | XmltvElement::REQUIRED,
            'start'            => XmltvElement::SINGLE | XmltvElement::REQUIRED,
            'stop'             => XmltvElement::SINGLE,
            'pdc-start'        => XmltvElement::SINGLE,
            'vps-start'        => XmltvElement::SINGLE,
            'showview'         => XmltvElement::SINGLE,
            'videoplus'        => XmltvElement::SINGLE,
            'clumpidx'         => XmltvElement::SINGLE
        ];
    }

    public function getAllowedChildren()
    {
        return [
            'title'            => XmltvElement::REQUIRED,
            'sub-title'        => XmltvElement::ALLOWED,
            'desc'             => XmltvElement::ALLOWED,
            'credits'          => XmltvElement::SINGLE,
            'date'             => XmltvElement::SINGLE,
            'category'         => XmltvElement::ALLOWED,
            'keyword'          => XmltvElement::ALLOWED,
            'language'         => XmltvElement::SINGLE,
            'orig-language'    => XmltvElement::SINGLE,
            'length'           => XmltvElement::SINGLE,
            'icon'             => XmltvElement::ALLOWED,
            'url'              => XmltvElement::ALLOWED,
            'country'          => XmltvElement::ALLOWED,
            'episode-num'      => XmltvElement::ALLOWED,
            'video'            => XmltvElement::SINGLE,
            'audio'            => XmltvElement::SINGLE,
            'previously-shown' => XmltvElement::SINGLE,
            'premiere'         => XmltvElement::SINGLE,
            'last-chance'      => XmltvElement::SINGLE,
            'new'              => XmltvElement::SINGLE,
            'subtitles'        => XmltvElement::ALLOWED,
            'rating'           => XmltvElement::ALLOWED,
            'star-rating'      => XmltvElement::ALLOWED,
            'review'           => XmltvElement::ALLOWED
        ];
    }
}
