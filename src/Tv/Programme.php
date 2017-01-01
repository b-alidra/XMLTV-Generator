<?php

namespace XMLTV\Tv;

use XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * XMLTV program.
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Programme extends XmltvElement
{
    /**
     * Add to this programme a <new/> child.
     *
     * @param callable $callback Callback function which receives the new
     *                           created element as argument
     */
    public function addNew($callback = null)
    {
        $new = new Programme\NewElement($this->_document, [], null, $callback);

        $this->children[] = $new;

        return $this;
    }

    /**
     * @see \XMLTV\XmltvElement::getTagName
     */
    public function getTagName()
    {
        return 'programme';
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedAttributes
     */
    public function getAllowedAttributes()
    {
        return [
            'channel'          => XmltvElement::SINGLE | XmltvElement::REQUIRED,
            'start'            => XmltvElement::SINGLE | XmltvElement::REQUIRED,
            'stop'             => XmltvElement::SINGLE,
            'pdc-start'        => XmltvElement::SINGLE,
            'vps-start'        => XmltvElement::SINGLE,
            'showview'         => XmltvElement::SINGLE,
            'videoplus'        => XmltvElement::SINGLE,
            'clumpidx'         => XmltvElement::SINGLE,
        ];
    }

    /**
     * @see \XMLTV\XmltvElement::getAllowedChildren
     */
    public function getAllowedChildren()
    {
        return [
            'title'            => XmltvElement::REQUIRED,
            'sub-title'        => XmltvElement::ALLOWED,
            'desc'             => XmltvElement::ALLOWED,
            'credits'          => XmltvElement::SINGLE,
            'date'             => XmltvElement::SINGLE,
            'category'         => XmltvElement::ALLOWED,
            'keyword'          => XmltvElement::ALLOWED,
            'language'         => XmltvElement::SINGLE,
            'orig-language'    => XmltvElement::SINGLE,
            'length'           => XmltvElement::SINGLE,
            'icon'             => XmltvElement::ALLOWED,
            'url'              => XmltvElement::ALLOWED,
            'country'          => XmltvElement::ALLOWED,
            'episode-num'      => XmltvElement::ALLOWED,
            'video'            => XmltvElement::SINGLE,
            'audio'            => XmltvElement::SINGLE,
            'previously-shown' => XmltvElement::SINGLE,
            'premiere'         => XmltvElement::SINGLE,
            'last-chance'      => XmltvElement::SINGLE,
            'new'              => XmltvElement::SINGLE,
            'subtitles'        => XmltvElement::ALLOWED,
            'rating'           => XmltvElement::ALLOWED,
            'star-rating'      => XmltvElement::ALLOWED,
            'review'           => XmltvElement::ALLOWED,
        ];
    }

    /**
     * @see \XMLTV\XmltvElement::checkValue
     */
    public function checkValue($value)
    {
        // Do not support any text content
        throw new XmltvException(
            sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_called_class()),
            XmltvException::UNSUPPORTED_VALUE_ERROR_CODE
        );
    }
}
