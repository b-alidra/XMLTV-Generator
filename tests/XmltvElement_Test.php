<?php
use XMLTV\Xmltv;
use XMLTV\XmltvElement;
use XMLTV\XmltvException;
use XMLTV\Tv\Channel;

/**
 * @coversDefaultClass \XMLTV\XmltvElement
 */
class XmltvElement_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::checkValue
     */
    public function testCheckNotScalarValue()
    {
        $xmltv = new Xmltv();
        $xmltv->addChannel(function (&$channel) {

            $this->expectException('\XMLTV\XmltvException');
            $this->expectExceptionCode(\XMLTV\XmltvException::UNSUPPORTED_VALUE_ERROR_CODE);
            $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_class($channel)));

            $channel->checkValue([]);
        });
    }

    /**
     * @covers ::checkAttributeValue
     */
    public function testCheckMultipleAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue(['id' => XmltvElement::ALLOWED]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::MULTIPLE_ATTRIBUTE_ERROR_MESSAGE, get_class($stub), 'id'));

        $stub->setId('test-id');
        $stub->checkAttributeValue('id', 'test-id');
    }

    /**
     * @covers ::checkAttributeValue
     */
    public function testCheckNonScalarAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue(['id' => XmltvElement::ALLOWED]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::UNSUPPORTED_VALUE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_class($stub)));

        $stub->checkAttributeValue('id', new stdClass());
    }

    /**
     * @covers ::_setAttribute
     */
    public function testSettingGoodAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue(['id' => XmltvElement::ALLOWED]));

        $stub->setId('test-id');
    }

    /**
     * @covers ::_addChild
     */
    public function testAddChild()
    {
        $xmltv = new Xmltv();
        $xmltv->addChannel(function (&$channel) {
            $this->assertInstanceOf('\XMLTV\Tv\Channel', $channel);
        });
    }

    /**
     * @covers ::validate
     */
    public function testValidationMissingAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue(['id' => XmltvElement::REQUIRED]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::MISSING_ATTRIBUTE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::MISSING_ATTRIBUTE_ERROR_MESSAGE, get_class($stub), 'id'));

        $stub->validate();
    }

    /**
     * @covers ::validate
     */
    public function testValidationMissingChild()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes', 'getAllowedChildren'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue([]));
        $stub->expects($this->any())
             ->method('getAllowedChildren')
             ->will($this->returnValue(['title' => XmltvElement::REQUIRED]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::MISSING_CHILD_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::MISSING_CHILD_ERROR_MESSAGE, get_class($stub), 'title'));

        $stub->validate();
    }

    /**
     * @covers ::validate
     * @covers ::_attachChildren
     * @covers ::remove
     */
    public function testValidationMultipleChild()
    {

        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme
                ->setChannel('test-channel')
                ->setStart('20162530013200')
                ->addTitle('Test')
                ->addCredits(function (&$credits) {
                    $credits->addActor('Belkacem Alidra');
                })
                ->addCredits();

            $this->expectException('\XMLTV\XmltvException');
            $this->expectExceptionCode(\XMLTV\XmltvException::MULTIPLE_CHILD_ERROR_CODE);
            $this->expectExceptionMessage(sprintf(XmltvException::MULTIPLE_CHILD_ERROR_MESSAGE, get_class($programme), 'credits'));

            $programme->validate();
        });
    }

    /**
     * @covers ::__call
     */
    public function testAddingAnAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes', '_setAttribute'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue(['id' => XmltvElement::ALLOWED]));

        $stub->expects($this->once())
                 ->method('_setAttribute')
                 ->with('id');

        $stub->setId('test-id');
    }

    /**
     * @covers ::__call
     */
    public function testAddingAChild()
    {
        $document = new \DomDocument();
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([$document])
            ->setMethods(['getAllowedChildren', '_addChild'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedChildren')
             ->will($this->returnValue(['title' => XmltvElement::ALLOWED]));

        $attributes = ['test-attr' => 'test-value'];
        $value      = 'test-title';
        $callback   = function (&$child) {};

        $stub->expects($this->once())
                 ->method('_addChild')
                 ->with('title', $attributes, $value, $callback);

        $stub->addTitle($attributes, $value, $callback);
    }

    /**
     * @covers ::__call
     */
    public function testAddingUnsupportedAttribute()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedAttributes')
             ->will($this->returnValue([]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE, get_class($stub), 'Id'));

        $stub->setId('unsupported-attribute');
    }

    /**
     * @covers ::__call
     */
    public function testAddingUnsupportedChild()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedChildren'])
            ->getMock();

        $stub->expects($this->any())
             ->method('getAllowedChildren')
             ->will($this->returnValue([]));

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::UNSUPPORTED_CHILD_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_CHILD_ERROR_MESSAGE, get_class($stub), 'Title'));

        $stub->addTitle('unsupported-child');
    }

    /**
     * @covers ::__call
     */
    public function testCallingUnknownMethod()
    {
        $stub = $this->getMockBuilder('\XMLTV\Tv\Channel')
            ->setConstructorArgs([new \DomDocument()])
            ->setMethods(['getAllowedAttributes', 'getAllowedChildren'])
            ->getMock();

        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(\XMLTV\XmltvException::UNKNOWN_METHOD_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNKNOWN_METHOD_ERROR_MESSAGE, get_class($stub), 'unknownMethod'));

        $stub->unknownMethod();
    }
}
