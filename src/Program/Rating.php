<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program rating
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Rating extends XmltvElement
{
    public function getTagName()
    {
        return 'rating';
    }

    public function getAllowedAttributes()
    {
        return [ 'system' => XmltvElement::SINGLE ];
    }

    public function getAllowedChildren()
    {
        return [
            'value' => XmltvElement::REQUIRED,
            'icon'  => XmltvElement::ALLOWED
        ];
    }
}
