<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits guest
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Guest extends XmltvElement
{
    public function getTagName()
    {
        return 'guest';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
