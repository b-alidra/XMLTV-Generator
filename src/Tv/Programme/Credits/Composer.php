<?php

namespace XMLTV\Tv\Programme\Credits;

use XMLTV\XmltvElement;

/**
 * XMLTV program credits composer.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Composer extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'composer';
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
