<?php
use XMLTV\Xmltv;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Subtitles
 */
class ProgrammeSubtitles_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addSubtitles(function (&$subtitles) {
                $this->element = $subtitles;
            });
        });
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

    /**
     * @covers ::checkAttributeValue
     */
    public function testCheckAllowedAttributeValues()
    {
        $this->assertItShouldAllowAttribute('type', 'teletext');
        $this->assertItShouldAllowAttribute('type', 'onscreen');
        $this->assertItShouldAllowAttribute('type', 'deaf-signed');

        $this->assertItShouldNotAllowAttributeValue('type', 'random value');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
