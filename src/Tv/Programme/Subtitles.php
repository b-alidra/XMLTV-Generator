<?php
namespace XMLTV\Tv\Programme;

use \Xmltv\XmltvElement;

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
        return [
            'language'         => XmltvElement::SINGLE
        ];
    }
}
