<?php
use XMLTV\Xmltv;

require_once(dirname(__FILE__) . '/../../XmltvElementTestCase.php');

/**
 * @coversDefaultClass \XMLTV\Tv\Programme\Length
 */
class ProgrammeLength_Test extends Xmltv_Element_TestCase
{
    protected function setUp()
    {
        $xmltv = new Xmltv();
        $xmltv->addProgramme(function (&$programme) {
            $programme->addLength(function (&$length) {
                $this->element = $length;
            });
        });
    }

    /**
     * @covers ::getTagName
     */
    public function testGetTagName()
    {
        $this->assertEquals('length', $this->element->getTagName());
    }

    /**
     * @covers ::getAllowedAttributes
     */
    public function testGetAllowedAttributes()
    {
        $this->assertItShouldRequireAttribute('units');
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
        $this->assertItShouldAllowAttribute('units', 'seconds');
        $this->assertItShouldAllowAttribute('units', 'minutes');
        $this->assertItShouldAllowAttribute('units', 'hours');

        $this->assertItShouldNotAllowAttributeValue('units', 'random value');
    }
}
