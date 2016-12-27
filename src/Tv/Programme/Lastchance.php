<?php
namespace XMLTV\Tv\Programme;

use \Xmltv\XmltvElement;

/**
 * XMLTV program last chance
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Lastchance extends XmltvElement
{
    public function getTagName()
    {
        return 'last-chance';
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
