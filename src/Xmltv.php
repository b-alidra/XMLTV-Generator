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
    protected $_document;

    /**
     * @var XMLTV\Tv
     */
    protected $root;

    public function __construct($attributes = [])
    {
        $this->_document = $this->_createDocument();
        $this->root      = new Tv($this->_document, $attributes);

        $this->root->appendTo($this->_document);
    }

    public function validateDTD()
    {
        return $this->_document->validate();
    }

    public function toXml()
    {
        $this->root->validate();
        return $this->_document->saveXml();
    }

    protected function _createDocument()
    {
        $implementation = new \DOMImplementation();
        $dtd            = $implementation->createDocumentType('tv', 'SYSTEM', 'http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd');
        $document = $implementation->createDocument('', '', $dtd);

        $document->encoding           = 'UTF-8';
        $document->preserveWhiteSpace = false;
        $document->formatOutput       = true;

        return $document;
    }

    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            return call_user_func_array([$this->root, $name], $arguments);
        }
    }
}
