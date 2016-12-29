<?php
use XMLTV\Tv\Programme\Credits\Actor;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Credits\Actor
 */
class ProgrammeActor_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Actor();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('actor', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowAttribute('role');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
