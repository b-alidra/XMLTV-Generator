<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program icon
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Icon extends XmltvElement
{
    public function getTagName()
    {
        return 'icon';
    }

    public function getAllowedAttributes()
    {
        return [
            'src'    => XmltvElement::SINGLE,
            'width'  => XmltvElement::SINGLE,
            'height' => XmltvElement::SINGLE,
        ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
