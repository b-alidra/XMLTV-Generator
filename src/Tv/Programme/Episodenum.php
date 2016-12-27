<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program episode number
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Episodenum extends XmltvElement
{
    public function getTagName()
    {
        return 'episode-num';
    }

    public function getAllowedAttributes()
    {
        return [ 'system' => XmltvElement::ALLOWED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
