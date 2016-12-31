<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../../../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Subtitles\Language
 */
class SubtitlesLanguage_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addSubtitles(function (&$subtitles) {
                $subtitles->addLanguage(function (&$language) {
                    $this->element = $language;
                });
            });
        });
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
