<?php
namespace XMLTV\Tv\Programme;

use \Xmltv\XmltvElement;

/**
 * XMLTV program category
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Category extends XmltvElement
{
    public function getTagName()
    {
        return 'category';
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
