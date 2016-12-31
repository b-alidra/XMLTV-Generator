<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Channel\Icon
 */
class ChannelIcon_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addChannel(function (&$channel) {
            $channel->addIcon(function (&$icon) {
                $this->element = $icon;
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('icon', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowNAttributes(3)
            ->assertItShouldRequireAttribute('src')
            ->assertItShouldAllowAttribute('width')
            ->assertItShouldAllowAttribute('height');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
