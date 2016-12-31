<?php

namespace XMLTV\Tv\Programme\Video;

use XMLTV\XmltvElement;

/**
 * XMLTV program video present.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Present extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'present';
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
