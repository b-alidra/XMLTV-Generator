<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../../../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Video\Present
 */
class VideoPresent_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addVideo(function (&$video) {
                $video->addPresent(function (&$present) {
                    $this->element = $present;
                });
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('present', $this->element->getTagName());
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
        $this->assertItShouldNotAllowChildren();
    }
}
