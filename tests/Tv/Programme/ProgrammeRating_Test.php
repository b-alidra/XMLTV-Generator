<?php
use XMLTV\Xmltv;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Rating
 */
class ProgrammeRating_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addRating(function (&$rating) {
                $this->element = $rating;
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('rating', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowSingleAttribute('system');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this
            ->assertItShouldRequireChild('value')
            ->assertItShouldAllowChild('icon');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
