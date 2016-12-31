<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;

/**
 * XMLTV program last chance.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Lastchance extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'last-chance';
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
