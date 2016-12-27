<?php
namespace XMLTV\Tv\Programme\Audio;

use \XMLTV\XmltvElement;

/**
 * XMLTV program audio present
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Present extends XmltvElement
{
    public function getTagName()
    {
        return 'present';
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
