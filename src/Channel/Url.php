<?php
namespace XMLTV\Channel;

use \Xmltv\XmltvElement;

/**
 * XMLTV channel url
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Url extends XmltvElement
{
    public function getTagName()
    {
        return 'url';
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
