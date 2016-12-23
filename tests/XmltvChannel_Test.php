<?php
use XMLTV\Xmltv;
use XMLTV\XmltvChannel;
use XMLTV\XmltvProgram;

class XmltvChannel_Test extends PHPUnit_Framework_TestCase {

    public function testOutput()
    {
        $attributes = [ 'id' => 'test_id' ];
        $children   = [
            'display-name' => 'test_name',
            'icon'         => 'https://b-alidra.com/icon.png',
            'url'          => 'https://b-alidra.com'
        ];
        $expected_xml = <<<EOF
<?xml version="1.0"?>
<channel id="test_id"><display-name>test_name</display-name><icon>https://b-alidra.com/icon.png</icon><url>https://b-alidra.com</url></channel>

EOF;
        $channel = new XmltvChannel($attributes, $children);
        $this->assertEquals($expected_xml, (string)$channel->getXml()->asXml());
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\XmltvChannel: Missing id attribute
     */
    public function testValidationWithoutId()
    {
        $attributes = [];
        $children   = [ 'display-name' => 'test_name' ];
        $channel = new XmltvChannel($attributes, $children);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\XmltvChannel: Missing display-name child
     */
    public function testValidationWithoutDisplayName()
    {
        $attributes = [ 'id' => 'test_id' ];
        $children   = [];
        $channel = new XmltvChannel($attributes, $children);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\XmltvChannel: Unsupported foo attribute
     */
    public function testValidationWithUnsupportedAttribute()
    {
        $attributes = [ 'id' => 'test_id', 'foo' => 'bar' ];
        $children   = [ 'display-name' => 'test_name' ];
        $channel = new XmltvChannel($attributes, $children);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNSUPPORTED_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\XmltvChannel: Unsupported foo child
     */
    public function testValidationWithUnsupportedChild()
    {
        $attributes = [ 'id' => 'test_id' ];
        $children   = [ 'display-name' => 'test_name', 'foo' => 'bar' ];
        $channel = new XmltvChannel($attributes, $children);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\XmltvChannel: Multiple id attribute
     */
    public function testValidationWithMultipleIdAttributes()
    {
        $attributes = [ 'id' => 'test_id' ];
        $children   = [ 'display-name' => 'test_name' ];
        $channel = new XmltvChannel($attributes, $children);
        $channel->addAttribute('id', 'second_id_value');
        $channel->validate();
    }
}
