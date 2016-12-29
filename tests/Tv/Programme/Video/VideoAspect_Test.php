<?php
use XMLTV\Tv\Programme\Video\Aspect;

require_once(dirname(__FILE__) . '/../../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Video\Aspect
 */
class VideoAspect_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Aspect();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('aspect', $this->element->getTagName());
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
