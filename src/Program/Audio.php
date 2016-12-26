<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program audio
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Audio extends XmltvElement
{
    public function getTagName()
    {
        return 'audio';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [
            'present' => XmltvElement::SINGLE,
            'stereo'  => XmltvElement::SINGLE
        ];
    }
}
