<?php

namespace XMLTV\Tv\Programme\Video;

use XMLTV\XmltvElement;

/**
 * XMLTV program video colour.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Colour extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'colour';
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
