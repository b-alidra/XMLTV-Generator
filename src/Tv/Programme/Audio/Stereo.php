<?php

namespace XMLTV\Tv\Programme\Audio;

use XMLTV\XmltvElement;

/**
 * XMLTV program audio stereo.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Stereo extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'stereo';
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
