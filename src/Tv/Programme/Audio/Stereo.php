<?php
namespace XMLTV\Tv\Programme\Audio;

use \XMLTV\XmltvElement;

/**
 * XMLTV program audio stereo
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Stereo extends XmltvElement
{
    public function getTagName()
    {
        return 'stereo';
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
