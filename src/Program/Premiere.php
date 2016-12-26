<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program premiere
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Premiere extends XmltvElement
{
    public function getTagName()
    {
        return 'premiere';
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
