<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits composer
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Composer extends XmltvElement
{
    public function getTagName()
    {
        return 'composer';
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
