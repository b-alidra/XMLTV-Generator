<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits writer
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Writer extends XmltvElement
{
    public function getTagName()
    {
        return 'writer';
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
