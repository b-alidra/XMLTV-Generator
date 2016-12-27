<?php
namespace XMLTV\Tv\Programme\Video;

use \Xmltv\XmltvElement;

/**
 * XMLTV program video aspect
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Aspect extends XmltvElement
{
    public function getTagName()
    {
        return 'aspect';
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
