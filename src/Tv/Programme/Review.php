<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**
 * XMLTV program review
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Review extends XmltvElement
{
    public function getTagName()
    {
        return 'review';
    }

    public function getAllowedAttributes()
    {
        return [
            'type'     => XmltvElement::REQUIRED,
            'source'   => XmltvElement::SINGLE,
            'reviewer' => XmltvElement::SINGLE,
            'lang'     => XmltvElement::SINGLE
        ];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
