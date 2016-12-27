<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program value
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Value extends XmltvElement
{
    public function getTagName()
    {
        return 'value';
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
