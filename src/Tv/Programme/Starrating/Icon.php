<?php
namespace XMLTV\Tv\Programme\StarRating;

use \XMLTV\XmltvElement;

/**
 * XMLTV program star rating icon
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
            'src'    => XmltvElement::REQUIRED,
            'width'  => XmltvElement::SINGLE,
            'height' => XmltvElement::SINGLE,
        ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
