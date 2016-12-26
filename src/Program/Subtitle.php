<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program sub-title
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Subtitle extends XmltvElement
{
    public function getTagName()
    {
        return 'sub-title';
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
