<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program original language
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class OrigLanguage extends XmltvElement
{
    public function getTagName()
    {
        return 'orig-language';
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
