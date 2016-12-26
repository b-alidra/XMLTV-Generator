<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program length
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Length extends XmltvElement
{
    public function getTagName()
    {
        return 'length';
    }

    public function getAllowedAttributes()
    {
        return [ 'units' => XmltvElement::REQUIRED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
