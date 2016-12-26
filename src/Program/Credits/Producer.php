<?php
namespace XMLTV\Program\Credits;

use \Xmltv\XmltvElement;

/**
 * XMLTV program credits producer
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Producer extends XmltvElement
{
    public function getTagName()
    {
        return 'producer';
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
