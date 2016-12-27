<?php
namespace XMLTV\Tv\Programme\Credits;

use \Xmltv\XmltvElement;

/**
 * XMLTV program credits editor
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Editor extends XmltvElement
{
    public function getTagName()
    {
        return 'editor';
    }

    public function getAllowedAttributes()
    {
        return [];
    }

    public function getAllowedChildren()
    {
        return [];
    }
}
