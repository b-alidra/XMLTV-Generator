<?php
namespace XMLTV\Program\Credits;

use \Xmltv\XmltvElement;

/**
 * XMLTV program credits writer
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Writer extends XmltvElement
{
    public function getTagName()
    {
        return 'writer';
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
