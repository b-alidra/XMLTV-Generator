<?php
use XMLTV\Tv\Programme\Country;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Country
 */
class ProgrammeCountry_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Country();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('country', $this->element->getTagName());
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
