<?php
use XMLTV\Tv\Programme\Video;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Video
 */
class ProgrammeVideo_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Video();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('video', $this->element->getTagName());
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
            ->assertItShouldAllowNChildren(4)
            ->assertItShouldAllowSingleChild('present')
            ->assertItShouldAllowSingleChild('colour')
            ->assertItShouldAllowSingleChild('aspect')
            ->assertItShouldAllowSingleChild('quality');
    }
}
