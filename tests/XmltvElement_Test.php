<?php
use XMLTV\XmltvElement;

class XmltvElement_Test extends PHPUnit_Framework_TestCase
{
    protected $stub;

    protected function setUp()
    {
        $this->stub = $this->getMockBuilder('\XMLTV\XmltvElement')
            ->disableOriginalConstructor()
            ->setMethods(array('getTagName', 'getAllowedAttributes', 'getAllowedChildren'))
            ->getMockForAbstractClass();
        $this->stub ->expects($this->any())
                    ->method('getTagName')
                    ->will($this->returnValue('test_tag'));
        $this->stub ->expects($this->any())
                    ->method('getAllowedAttributes')
                    ->will($this->returnValue([
                        'id' => XmltvElement::ALLOWED
                    ]));
        $this->stub ->expects($this->any())
                    ->method('getAllowedChildren')
                    ->will($this->returnValue([
                        'name' => 'test_name'
                    ]));
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Missing id attribute
     */
    public function testValidationWithoutId()
    {
        $channel = new Channel([]);
        $channel
            ->addDisplayname([], 'test_name')
            ->addIcon(['src' => 'https://b-alidra.com/icon.png'])
            ->addUrl([], 'https://b-alidra.com');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Missing display-name child
     */
    public function testValidationWithoutDisplayName()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Unsupported foo attribute
     */
    public function testValidationWithUnsupportedAttribute()
    {
        $channel = new Channel([ 'id' => 'test_id', 'foo' => 'bar' ]);
        $channel->addDisplayname([], 'test_name');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNKNOWN_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Trying to set the value of an unknown Foo attribute
     */
    public function testMagisSetterWithUnsupportedAttribute()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->setFoo([], 'bar');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNKNOWN_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Trying to add an unknown Foo child
     */
    public function testMagicSetterWithUnsupportedChild()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->addFoo('bar')
            ->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Multiple id attribute
     */
    public function testValidationWithMultipleIdAttributes()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->setId('id', 'second_id_value')
            ->validate();
    }
}
