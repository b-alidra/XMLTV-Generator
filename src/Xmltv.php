<?php
namespace XMLTV;

/**
 * XMLTV generator
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class Xmltv
{
    /**
     * @var \DomDocument
     */
    protected static $document;

    /**
     * @var XMLTV\Tv
     */
    protected $root;

    public function __construct($attributes = [])
    {
        $this->root = new Tv($attributes);
        $this->root->appendTo(static::getDocument());
    }

    public static function getDocument()
    {
        if (is_null(static::$document)) {
            $implementation = new \DOMImplementation();
            $dtd            = $implementation->createDocumentType('tv', 'SYSTEM', 'http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd');
            static::$document = $implementation->createDocument('', '', $dtd);

            static::$document->encoding           = 'UTF-8';
            static::$document->preserveWhiteSpace = false;
            static::$document->formatOutput       = true;
        }

        return static::$document;
    }

    public function validate()
    {
        return static::getDocument()->validate();
    }

    public function toXml()
    {
        $this->root->validate();
        return static::getDocument()->saveXml();
    }

    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            return call_user_func_array([$this->root, $name], $arguments);
        }
    }
}
