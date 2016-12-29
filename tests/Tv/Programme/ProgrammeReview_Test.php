<?php
use XMLTV\Tv\Programme\Review;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Review
 */
class ProgrammeReview_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $this->element = new Review();
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('review', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this
            ->assertItShouldRequireAttribute('type')
            ->assertItShouldAllowSingleAttribute('source')
            ->assertItShouldAllowSingleAttribute('reviewer')
            ->assertItShouldAllowSingleAttribute('lang');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
