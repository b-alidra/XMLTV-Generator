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
    public function getTagName()
    {
        return 'display-name';
    }

    public function getAllowedAttributes()
    {
        return [ 'lang' => XmltvElement::ALLOWED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
