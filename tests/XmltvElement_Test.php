<?php
use XMLTV\XmltvElement;

class XmltvElement_Test extends PHPUnit_Framework_TestCase {
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
}
