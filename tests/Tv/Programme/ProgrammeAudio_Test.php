<?php
use XMLTV\Tv\Programme\Audio;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Audio
 */
class ProgrammeAudio_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Audio();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('audio', $this->element->getTagName());
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
            ->assertItShouldAllowNChildren(2)
            ->assertItShouldAllowSingleChild('present')
            ->assertItShouldAllowSingleChild('stereo');
    }
}
