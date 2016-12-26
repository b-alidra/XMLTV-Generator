<?php
namespace XMLTV\Program\Credits;

use \Xmltv\XmltvElement;

/**
 * XMLTV program credits presenter
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Presenter extends XmltvElement
{
    public function getTagName()
    {
        return 'presenter';
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
