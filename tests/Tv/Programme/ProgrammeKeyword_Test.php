<?php
use XMLTV\Tv\Programme\Keyword;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Keyword
 */
class ProgrammeKeyword_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Keyword();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('keyword', $this->element->getTagName());
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
