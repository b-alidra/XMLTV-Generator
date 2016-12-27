<?php
namespace XMLTV\Tv\Programme;

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
