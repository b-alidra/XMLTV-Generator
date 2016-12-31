<?php

namespace XMLTV\Tv\Programme\Credits;

use XMLTV\XmltvElement;

/**
 * XMLTV program credits actor.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Actor extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'actor';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return ['role' => XmltvElement::ALLOWED];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
    }
}
