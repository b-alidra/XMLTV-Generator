<?php
use XMLTV\Tv\Programme\Starrating;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Starrating
 */
class ProgrammeStarrating_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Starrating();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('star-rating', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowSingleAttribute('system');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this
            ->assertItShouldRequireChild('value')
            ->assertItShouldAllowChild('icon');
    }
}
