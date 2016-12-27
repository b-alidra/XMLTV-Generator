<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program country
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Country extends XmltvElement
{
    public function getTagName()
    {
        return 'country';
    }

    public function getAllowedAttributes()
    {
        return [ 'lang' => XmltvElement::ALLOWED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
