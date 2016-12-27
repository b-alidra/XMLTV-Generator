<?php
namespace XMLTV\Tv\Programme;

use \Xmltv\XmltvElement;

/**
 * XMLTV program description
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Desc extends XmltvElement
{
    public function getTagName()
    {
        return 'desc';
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
