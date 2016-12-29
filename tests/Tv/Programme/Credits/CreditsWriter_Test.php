<?php
use XMLTV\Tv\Programme\Credits\Writer;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Credits\Writer
 */
class ProgrammeWriter_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Writer();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('writer', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldNotAllowAttributes();
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
