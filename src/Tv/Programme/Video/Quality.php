<?php
namespace XMLTV\Tv\Programme\Video;

use \XMLTV\XmltvElement;

/**
 * XMLTV program video quality
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Quality extends XmltvElement
{
    public function getTagName()
    {
        return 'quality';
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
