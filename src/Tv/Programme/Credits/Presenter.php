<?php
namespace XMLTV\Tv\Programme\Credits;

use \XMLTV\XmltvElement;

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
