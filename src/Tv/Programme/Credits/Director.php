<?php
namespace XMLTV\Tv\Programme\Credits;

use \Xmltv\XmltvElement;

/**
 * XMLTV program credits director
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Director extends XmltvElement
{
    public function getTagName()
    {
        return 'director';
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
