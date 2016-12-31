<?php
use XMLTV\Xmltv;

require_once(dirname(__FILE__) . '/../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme
 */
class Programme_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $this->element = $programme;
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('programme', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowNAttributes(8)
            ->assertItShouldRequireAttribute('channel')
            ->assertItShouldAllowSingleAttribute('channel')
            ->assertItShouldRequireAttribute('start')
            ->assertItShouldAllowSingleAttribute('start')
            ->assertItShouldAllowSingleAttribute('stop')
            ->assertItShouldAllowSingleAttribute('pdc-start')
            ->assertItShouldAllowSingleAttribute('vps-start')
            ->assertItShouldAllowSingleAttribute('showview')
            ->assertItShouldAllowSingleAttribute('videoplus')
            ->assertItShouldAllowSingleAttribute('clumpidx');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this
            ->assertItShouldAllowNChildren(24)
            ->assertItShouldRequireChild('title')
            ->assertItShouldAllowChild('sub-title')
            ->assertItShouldAllowChild('desc')
            ->assertItShouldAllowSingleChild('credits')
            ->assertItShouldAllowSingleChild('date')
            ->assertItShouldAllowChild('category')
            ->assertItShouldAllowChild('keyword')
            ->assertItShouldAllowSingleChild('language')
            ->assertItShouldAllowSingleChild('orig-language')
            ->assertItShouldAllowSingleChild('length')
            ->assertItShouldAllowChild('icon')
            ->assertItShouldAllowChild('url')
            ->assertItShouldAllowChild('country')
            ->assertItShouldAllowChild('episode-num')
            ->assertItShouldAllowSingleChild('video')
            ->assertItShouldAllowSingleChild('audio')
            ->assertItShouldAllowSingleChild('previously-shown')
            ->assertItShouldAllowSingleChild('premiere')
            ->assertItShouldAllowSingleChild('last-chance')
            ->assertItShouldAllowSingleChild('new')
            ->assertItShouldAllowChild('subtitles')
            ->assertItShouldAllowChild('rating')
            ->assertItShouldAllowChild('star-rating')
            ->assertItShouldAllowChild('review');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
