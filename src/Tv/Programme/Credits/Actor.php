<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

/**
 * XMLTV program credits actor
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Actor extends XmltvElement
{
    public function getTagName()
    {
        return 'actor';
    }

    public function getAllowedAttributes()
    {
        return [ 'role' => XmltvElement::ALLOWED ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
