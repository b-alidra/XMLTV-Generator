<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program previously shown
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Previouslyshown extends XmltvElement
{
    public function getTagName()
    {
        return 'previously-shown';
    }

    public function getAllowedAttributes()
    {
        return [
            'start'   => XmltvElement::ALLOWED,
            'channel' => XmltvElement::ALLOWED
        ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
