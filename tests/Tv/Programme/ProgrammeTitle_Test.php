<?php
use XMLTV\Tv\Programme\Title;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Title
 */
class ProgrammeTitle_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Title();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('title', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowAttribute('lang');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
