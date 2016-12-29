<?php
use XMLTV\Tv\Programme\Credits\Editor;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Credits\Editor
 */
class ProgrammeEditor_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Editor();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('editor', $this->element->getTagName());
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
