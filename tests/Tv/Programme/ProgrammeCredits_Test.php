<?php
use XMLTV\Tv\Programme\Credits;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Credits
 */
class ProgrammeCredits_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Credits();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('credits', $this->element->getTagName());
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
        $this
            ->assertItShouldAllowNChildren(10)
            ->assertItShouldAllowChild('director')
            ->assertItShouldAllowChild('actor')
            ->assertItShouldAllowChild('writer')
            ->assertItShouldAllowChild('adapter')
            ->assertItShouldAllowChild('producer')
            ->assertItShouldAllowChild('composer')
            ->assertItShouldAllowChild('editor')
            ->assertItShouldAllowChild('presenter')
            ->assertItShouldAllowChild('commentator')
            ->assertItShouldAllowChild('guest');
    }
}