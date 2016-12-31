<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;

/**
 * XMLTV program language.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Language extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'language';
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
