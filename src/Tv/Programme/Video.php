<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program video
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Video extends XmltvElement
{
    public function getTagName()
    {
        return 'video';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [
            'present' => XmltvElement::SINGLE,
            'colour'  => XmltvElement::SINGLE,
            'aspect'  => XmltvElement::SINGLE,
            'quality' => XmltvElement::SINGLE
        ];
    }
}
