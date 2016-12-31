<?php
namespace XMLTV\Tv\Channel;

use \XMLTV\XmltvElement;

/**
 * XMLTV channel display name
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Displayname extends XmltvElement
{
    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'display-name';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [ 'lang' => XmltvElement::ALLOWED ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [];
    }
}
