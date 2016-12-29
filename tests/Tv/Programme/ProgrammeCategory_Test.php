<?php
use XMLTV\Tv\Programme\Category;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Category
 */
class ProgrammeCategory_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Category();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('category', $this->element->getTagName());
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
