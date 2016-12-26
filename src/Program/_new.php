<?php
namespace XMLTV\Program;

use \Xmltv\XmltvElement;

/**
 * XMLTV program new
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class _new extends XmltvElement
{
    public function getTagName()
    {
        return 'new';
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
