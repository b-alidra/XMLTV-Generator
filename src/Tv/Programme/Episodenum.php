<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;

/**
 * XMLTV program episode number.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Episodenum extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'episode-num';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return ['system' => XmltvElement::ALLOWED];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
    }
}
