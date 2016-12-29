<?php
use XMLTV\Tv\Programme\Lastchance;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Lastchance
 */
class ProgrammeLastchance_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Lastchance();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('last-chance', $this->element->getTagName());
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
