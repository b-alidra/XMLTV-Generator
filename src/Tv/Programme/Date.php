<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program date
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Date extends XmltvElement
{
    public function getTagName()
    {
        return 'date';
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
