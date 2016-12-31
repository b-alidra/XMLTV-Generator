<?php

namespace XMLTV\Tv\Programme\Video;

use XMLTV\XmltvElement;

/**
 * XMLTV program video aspect.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Aspect extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'aspect';
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
