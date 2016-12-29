<?php
use XMLTV\Tv\Programme\Rating\Icon;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Rating\Icon
 */
class RatingIcon_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Icon();
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
}
