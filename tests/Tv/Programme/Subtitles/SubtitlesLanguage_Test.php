<?php
use XMLTV\Tv\Programme\Subtitles\Language;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Subtitles\Language
 */
class SubtitlesLanguage_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Language();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('language', $this->element->getTagName());
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
