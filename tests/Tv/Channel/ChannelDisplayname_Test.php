<?php
use XMLTV\Tv\Channel\Displayname;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Channel\Displayname
 */
class ChannelDisplayname_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Displayname();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('display-name', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldAllowNAttributes(1)
            ->assertItShouldAllowAttribute('lang');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
