<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits adapter
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Adapter extends XmltvElement
{
    public function getTagName()
    {
        return 'adapter';
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
