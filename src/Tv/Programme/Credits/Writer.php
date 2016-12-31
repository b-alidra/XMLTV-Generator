<?php

namespace XMLTV\Tv\Programme\Credits;

use XMLTV\XmltvElement;

/**
 * XMLTV program credits writer.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Writer extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'writer';
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
