<?php
use XMLTV\Xmltv;
use XMLTV\XmltvElement;
use XMLTV\XmltvException;

/**
 * @coversDefaultClass \XMLTV\Tv\Channel\Displayname
 */
class Xmltv_Element_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var XMLTV\XmltvElement
     */
    protected $element;

    public function assertItShouldNotAllowAttributes()
    {
        $this->assertEmpty($this->element->getAllowedAttributes(), "It should not allow any attribute");
        return $this;
    }

    public function assertItShouldAllowNAttributes($n)
    {
        $this->assertCount($n, $this->element->getAllowedAttributes(), sprintf("It should allow %d attribute(s)", $n));
        return $this;
    }

    public function assertItShouldAllowAttribute($attribute)
    {
        $allowed = $this->element->getAllowedAttributes();
        $this->assertArrayHasKey($attribute, $allowed, sprintf("It should allow attribute %s", $attribute));

        return $this;
    }

    public function assertItShouldRequireAttribute($attribute)
    {
        $allowed = $this->element->getAllowedAttributes();
        $this->assertTrue(boolval($allowed[$attribute] & XmltvElement::REQUIRED), sprintf("It should require attribute %s", $attribute));
return $this;
    }

    public function assertItShouldAllowSingleAttribute($attribute)
    {
        $allowed = $this->element->getAllowedAttributes();
        $this->assertTrue(boolval($allowed[$attribute] & XmltvElement::SINGLE), sprintf("It should allow single attribute %s", $attribute));

        return $this;
    }

    public function assertItShouldAllowAttributeValue($attribute, $value)
    {
        $this->element->checkAttributeValue($attribute, $value);
        return $this;
    }

    public function assertItShouldNotAllowAttributeValue($attribute, $value)
    {
        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(XmltvException::UNSUPPORTED_VALUE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_class($this->element)));

        $this->element->checkAttributeValue($attribute, $value);
        return $this;
    }

    public function assertItShouldNotAllowChildren()
    {
        $this->assertEmpty($this->element->getAllowedChildren(), "It should not allow any child");
        return $this;
    }

    public function assertItShouldAllowNChildren($n)
    {
        $this->assertCount($n, $this->element->getAllowedChildren(), sprintf("It should allow %d children", $n));
        return $this;
    }

    public function assertItShouldAllowChild($child)
    {
        $allowed = $this->element->getAllowedChildren();
        $this->assertArrayHasKey($child, $allowed, sprintf("It should allow child %s", $child));

        return $this;
    }

    public function assertItShouldRequireChild($child)
    {
        $allowed = $this->element->getAllowedChildren();
        $this->assertTrue(boolval($allowed[$child] & XmltvElement::REQUIRED), sprintf("It should require child %s", $child));

        return $this;
    }

    public function assertItShouldAllowSingleChild($child)
    {
        $allowed = $this->element->getAllowedChildren();
        $this->assertTrue(boolval($allowed[$child] & XmltvElement::SINGLE), sprintf("It should allow single child %s", $child));

        return $this;
    }

    public function assertItShouldAllowValue($value)
    {
        $this->element->checkValue($value);
        return $this;
    }

    public function assertItShouldNotAllowValue($value)
    {
        $this->expectException('\XMLTV\XmltvException');
        $this->expectExceptionCode(XmltvException::UNSUPPORTED_VALUE_ERROR_CODE);
        $this->expectExceptionMessage(sprintf(XmltvException::UNSUPPORTED_VALUE_ERROR_MESSAGE, get_class($this->element)));

        $this->element->checkValue($value);

        return $this;
    }
}
