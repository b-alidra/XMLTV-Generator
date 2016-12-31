<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Credits
 */
class ProgrammeCredits_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addCredits(function (&$credits) {
                $this->element = $credits;
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('credits', $this->element->getTagName());
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
        $this
            ->assertItShouldAllowNChildren(10)
            ->assertItShouldAllowChild('director')
            ->assertItShouldAllowChild('actor')
            ->assertItShouldAllowChild('writer')
            ->assertItShouldAllowChild('adapter')
            ->assertItShouldAllowChild('producer')
            ->assertItShouldAllowChild('composer')
            ->assertItShouldAllowChild('editor')
            ->assertItShouldAllowChild('presenter')
            ->assertItShouldAllowChild('commentator')
            ->assertItShouldAllowChild('guest');
    }

    /**
     * @covers ::checkValue
     */
    public function testCheckAnyValue()
    {
        $this->assertItShouldNotAllowValue('random value');
    }
}
