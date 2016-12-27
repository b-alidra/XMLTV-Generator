<?php
namespace XMLTV\Tv\Programme;

use \Xmltv\XmltvElement;

/**
 * XMLTV program language
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Language extends XmltvElement
{
    public function getTagName()
    {
        return 'language';
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
