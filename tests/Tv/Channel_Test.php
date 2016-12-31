<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Channel
 */
class Channel_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addChannel(function (&$channel) {
            $this->element = $channel;
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('channel', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowNAttributes(1)
            ->assertItShouldRequireAttribute('id');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this
            ->assertItShouldAllowNChildren(3)
            ->assertItShouldRequireChild('display-name')
            ->assertItShouldAllowChild('icon')
            ->assertItShouldAllowChild('url');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
