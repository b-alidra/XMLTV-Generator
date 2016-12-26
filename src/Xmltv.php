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

    public function addChannel($attributes = [])
    {
        $channel = new Channel($attributes);
        $this->channels[] = $channel;

        return $channel;
    }

    public function addProgram($attributes = [])
    {
        $program = new Program($attributes);
        $this->programs[] = $program;

        return $program;
    }

    public function output()
    {
        $this->validate();

        $implementation = new DOMImplementation();
        $dtd            = $implementation->createDocumentType('tv', 'SYSTEM', 'http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd');
        $document = $implementation->createDocument('', '', $dtd);
        $document->encoding = 'UTF-8';

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
