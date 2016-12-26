<?php
namespace XMLTV\Program\Subtitles;

use \Xmltv\XmltvElement;

/**
 * XMLTV program subtitles language
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Language extends XmltvElement
{
    public function getTagName()
    {
        return 'language';
    }

    public function getAllowedAttributes()
    {
        return [ 'lang' => XmltvElement::ALLOWED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
