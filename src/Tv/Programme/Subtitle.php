<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;

/**
 * XMLTV program sub-title.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Subtitle extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'sub-title';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return ['lang' => XmltvElement::ALLOWED];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
    }
}
