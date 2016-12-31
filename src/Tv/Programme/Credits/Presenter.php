<?php

namespace XMLTV\Tv\Programme\Credits;

use XMLTV\XmltvElement;

/**
 * XMLTV program credits presenter.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Presenter extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'presenter';
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
