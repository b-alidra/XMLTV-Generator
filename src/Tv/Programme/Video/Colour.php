<?php
namespace XMLTV\Tv\Programme\Video;

use \XMLTV\XmltvElement;

/**
 * XMLTV program video colour
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Colour extends XmltvElement
{
    public function getTagName()
    {
        return 'colour';
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
