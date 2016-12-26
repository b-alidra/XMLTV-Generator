<?php
namespace XMLTV\Program\Credits;

use \Xmltv\XmltvElement;

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
