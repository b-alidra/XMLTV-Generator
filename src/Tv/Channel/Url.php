<?php

namespace XMLTV\Tv\Channel;

use XMLTV\XmltvElement;

/**
 * XMLTV channel url.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Url extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'url';
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
