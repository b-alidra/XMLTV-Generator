<?php
namespace XMLTV;

/**
 * XMLTV channel
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class XmltvChannel extends XmltvElement
{
    public function getTagName()
    {
        return 'channel';
    }

    public function getAllowedAttributes()
    {
        return [ 'id' => XmltvElement::REQUIRED ];
    }

    public function getAllowedChildren()
    {
        return [
            'display-name' => XmltvElement::REQUIRED,
            'icon'         => XmltvElement::ALLOWED,
            'url'          => XmltvElement::ALLOWED
        ];
    }
}
