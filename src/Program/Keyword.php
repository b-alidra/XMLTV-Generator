<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program keyword
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Keyword extends XmltvElement
{
    public function getTagName()
    {
        return 'keyword';
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
