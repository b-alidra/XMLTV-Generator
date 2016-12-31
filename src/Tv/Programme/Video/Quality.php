<?php

namespace XMLTV\Tv\Programme\Video;

use XMLTV\XmltvElement;

/**
 * XMLTV program video quality.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Quality extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'quality';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
    }
}
