<?php
namespace XMLTV;

/**
 * XMLTV generator
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Xmltv extends XmltvElement
{
    protected $channels = [];
    protected $programs = [];

    public function __construct($attributes = [], $children = [])
    {
        $this->_xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
            <!DOCTYPE tv SYSTEM "xmltv.dtd"><tv/>');

        foreach ($attributes as $name => $value) {
            $this->addAttribute($name, $value);
        }

        foreach ($children as $name => $value) {
            $this->addChild($name, $value);
        }
    }

    public function getTagName()
    {
        return 'tv';
    }

    public function getAllowedAttributes()
    {
        return [
            'date'                => XmltvElement::ALLOWED,
            'source-info-url'     => XmltvElement::ALLOWED,
            'source-info-name'    => XmltvElement::ALLOWED,
            'source-data-url'     => XmltvElement::ALLOWED,
            'generator-info-name' => XmltvElement::ALLOWED,
            'generator-info-url'  => XmltvElement::ALLOWED,
        ];
    }

    public function getAllowedChildren()
    {
        return [
            'channel'             => XmltvElement::ALLOWED,
            'programme'           => XmltvElement::ALLOWED
        ];
    }

    public function addChannel($attributes = [], $children = [])
    {
        $channel = new XmltvChannel($attributes, $children);
        $this->channels[] = $channel;

        return $channel;
    }

    public function addProgram($attributes = [], $children = [])
    {
        $program = new XmltvProgram($attributes, $children);
        $this->programs[] = $program;

        return $program;
    }

    public function output()
    {
        $this->validate();

        $xml = $this->_xml;

        foreach ($this->channels as $channel) {
            $channel->validate();
            $xml = XmltvElement::merge($xml, $channel->getXml());
        }

        foreach ($this->programs as $program) {
            $program->validate();
            $xml = XmltvElement::merge($xml, $program->getXml());
        }

        return html_entity_decode($xml->asXml(), ENT_NOQUOTES, 'UTF-8');
    }
}
