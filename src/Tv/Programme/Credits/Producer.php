<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits producer
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Producer extends XmltvElement
{
    public function getTagName()
    {
        return 'producer';
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
