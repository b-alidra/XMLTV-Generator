<?php

namespace XMLTV\Tv\Programme\Credits;

use XMLTV\XmltvElement;

/**
 * XMLTV program credits producer.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Producer extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'producer';
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
