<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits commentator
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Commentator extends XmltvElement
{
    public function getTagName()
    {
        return 'commentator';
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
