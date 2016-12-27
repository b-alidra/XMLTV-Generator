<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program star rating
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Starrating extends XmltvElement
{
    public function getTagName()
    {
        return 'star-rating';
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
