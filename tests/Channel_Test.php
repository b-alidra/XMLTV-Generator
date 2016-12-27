<?php
use XMLTV\Xmltv;
use XMLTV\XmltvElement;
use XMLTV\Tv\Channel;
use XMLTV\Tv\Programme;

class Channel_Test extends PHPUnit_Framework_TestCase {

    public function testOutput()
    {
        $expected_xml = <<<EOF
<channel id="test_id">
  <display-name lang="fr">La Une</display-name>
  <display-name lang="en">The One</display-name>
  <icon width="80" height="120" src="https://b-alidra.com/icon.png"/>
  <icon width="80" height="120" src="https://b-alidra.com/icon2.png"/>
  <url>https://b-alidra.com</url>
</channel>
EOF;
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname(['lang' => 'fr'], 'La Une')
            ->addDisplayname(['lang' => 'en'], 'The One')
            ->addIcon(['width' => '80', 'height' => 120, 'src' => 'https://b-alidra.com/icon.png'])
            ->addIcon(['width' => '80', 'height' => 120, 'src' => 'https://b-alidra.com/icon2.png'])
            ->addUrl([], 'https://b-alidra.com');

        $this->assertEquals($expected_xml, $channel->toXml());
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Missing id attribute
     */
    public function testValidationWithoutId()
    {
        $channel = new Channel([]);
        $channel
            ->addDisplayname([], 'test_name')
            ->addIcon(['src' => 'https://b-alidra.com/icon.png'])
            ->addUrl([], 'https://b-alidra.com');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MISSING_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Missing display-name child
     */
    public function testValidationWithoutDisplayName()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNSUPPORTED_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Unsupported foo attribute
     */
    public function testValidationWithUnsupportedAttribute()
    {
        $channel = new Channel([ 'id' => 'test_id', 'foo' => 'bar' ]);
        $channel->addDisplayname([], 'test_name');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNKNOWN_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Trying to set the value of an unknown Foo attribute
     */
    public function testMagisSetterWithUnsupportedAttribute()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->setFoo([], 'bar');
        $channel->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::UNKNOWN_CHILD_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Trying to add an unknown Foo child
     */
    public function testMagicSetterWithUnsupportedChild()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->addFoo('bar')
            ->validate();
    }

    /**
     * @expectedException           \XMLTV\XmltvException
     * @expectedExceptionCode       \XMLTV\XmltvException::MULTIPLE_ATTRIBUTE_ERROR_CODE
     * @expectedExceptionMessage    XMLTV\Tv\Channel: Multiple id attribute
     */
    public function testValidationWithMultipleIdAttributes()
    {
        $channel = new Channel([ 'id' => 'test_id' ]);
        $channel
            ->addDisplayname([], 'test_name')
            ->setAttribute('id', 'second_id_value')
            ->validate();
    }
}
