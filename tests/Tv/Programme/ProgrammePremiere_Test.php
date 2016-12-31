<?php

use XMLTV\Xmltv;

require_once dirname(__FILE__).'/../../XmltvElementTestCase.php';

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Premiere
 */
class ProgrammePremiere_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addPremiere(function (&$premiere) {
                $this->element = $premiere;
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('premiere', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldAllowAttribute('lang');
    }

    /**
     * @covers ::getAllowedChildren
     */
    public function testGetAllowedChildren()
    {
        $this->assertItShouldNotAllowChildren();
    }
}
