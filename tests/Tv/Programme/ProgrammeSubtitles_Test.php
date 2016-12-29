<?php
use XMLTV\Tv\Programme\Subtitles;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Subtitles
 */
class ProgrammeSubtitles_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Subtitles();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('subtitles', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowSingleAttribute('type');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldAllowSingleChild('language');
    }
}
