<?php
namespace XMLTV\Tv\Programme;

use \XMLTV\XmltvElement;

/**

use \XMLTV\XmltvElement;
 * XMLTV program title
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Title extends XmltvElement
{
    public function getTagName()
    {
        return 'title';
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
