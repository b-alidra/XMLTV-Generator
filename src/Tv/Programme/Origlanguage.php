<?php

namespace XMLTV\Tv\Programme;

use XMLTV\XmltvElement;

/**
 * XMLTV program original language.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Origlanguage extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'orig-language';
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
