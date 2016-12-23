<?php
use XMLTV\Xmltv;
use XMLTV\XmltvChannel;
use XMLTV\XmltvProgram;

class XmltvProgram_Test extends PHPUnit_Framework_TestCase {

    public function testOutput()
    {
        $attributes = [
            'channel'          => 'test-channel',
            'start'            => '20161223184000',
            'stop'             => '20161223194000',
            'pdc-start'        => '20161223184000',
            'vps-start'        => '20161223184000',
            'showview'         => '???',
            'videoplus'        => '???',
            'clumpidx'         => '1'
        ];
        $children   = [
            'title'            => 'Test program',
            'sub-title'        => 'Test program subtitle',
            'desc'             => 'Test program description',
            //'credits'          => '',                         TODO: Handle it
            'date'             => '2016-06-15',
            'category'         => 'Horror',
            'keyword'          => 'Fantastic',
            'language'         => 'fr',
            'orig-language'    => 'en',
            'length'           => 120,
            'icon'             => 'https://b-alidra.com/icon.png',
            'url'              => 'https://b-alidra.com',
            'country'          => 'GB',
            'episode-num'      => '0.0.0/1',
            //'video'            => '',                         TODO: Handle it
            'audio'            => 'yes',
            //'previously-shown' => XmltvElement::SINGLE,       TODO: Handle it
            //'premiere'         => XmltvElement::SINGLE,
            'last-chance'      => '',
            'new'              => '',
            'subtitles'        => 'onscreen',
            'rating'           => '',
            'star-rating'      => '1/5',
            'review'           => ''
        ];
        $expected_xml = <<<EOF
<?xml version="1.0"?>
<programme channel="test-channel" start="20161223184000" stop="20161223194000" pdc-start="20161223184000" vps-start="20161223184000" showview="???" videoplus="???" clumpidx="1"><title>Test program</title><sub-title>Test program subtitle</sub-title><desc>Test program description</desc><date>2016-06-15</date><category>Horror</category><keyword>Fantastic</keyword><language>fr</language><orig-language>en</orig-language><length>120</length><icon>https://b-alidra.com/icon.png</icon><url>https://b-alidra.com</url><country>GB</country><episode-num>0.0.0/1</episode-num><audio>yes</audio><last-chance/><new/><subtitles>onscreen</subtitles><rating/><star-rating>1/5</star-rating><review/></programme>

EOF;
        $program = new XmltvProgram($attributes, $children);
        $this->assertEquals($expected_xml, (string)$program->getXml()->asXml());
    }
}
