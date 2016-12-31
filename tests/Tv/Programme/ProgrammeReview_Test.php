<?php
use XMLTV\Xmltv;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Review
 */
class ProgrammeReview_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addReview(function (&$review) {
                $this->element = $review;
            });
        });
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

    /**
     * @covers ::checkAttributeValue
     */
    public function testCheckAllowedAttributeValues()
    {
        $this->assertItShouldAllowAttribute('type', 'text');
        $this->assertItShouldAllowAttribute('type', 'url');

        $this->assertItShouldNotAllowAttributeValue('type', 'random value');
    }
}
