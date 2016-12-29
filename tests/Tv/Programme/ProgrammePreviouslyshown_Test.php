<?php
use XMLTV\Tv\Programme\Previouslyshown;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Previouslyshown
 */
class ProgrammePreviouslyshown_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Previouslyshown();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('previously-shown', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowAttribute('start')
            ->assertItShouldAllowAttribute('channel');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
