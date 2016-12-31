<?php

use XMLTV\Xmltv;
use XMLTV\XmltvException;

require_once dirname(__FILE__).'/XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv
 */
class Tv_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Xmltv();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('tv', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowNAttributes(6)
            ->assertItShouldAllowAttribute('date')
            ->assertItShouldAllowAttribute('source-info-url')
            ->assertItShouldAllowAttribute('source-info-name')
            ->assertItShouldAllowAttribute('source-data-url')
            ->assertItShouldAllowAttribute('generator-info-name')
            ->assertItShouldAllowAttribute('generator-info-url');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this
            ->assertItShouldAllowNChildren(2)
            ->assertItShouldAllowChild('channel')
            ->assertItShouldAllowChild('programme');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(XmltvException::UNSUPPORTED_VALUE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, 'XMLTV\Tv'));

        $this->element->checkValue('random value');

        return $this;
    }
}
