<?php

namespace XMLTV;

/**
 * XMLTV generator.
 *
 * @see http://wiki.xmltv.org/index.php/XMLTVFormat
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 *
 * @method \XMLTV\XmltvElement setDate(string $value)
 * @method \XMLTV\XmltvElement setSourceinfourl(string $source_info_url)
 * @method \XMLTV\XmltvElement setSourceinfoname(string $source_info_name)
 * @method \XMLTV\XmltvElement setSourceDataUrl(string $source_data_url)
 * @method \XMLTV\XmltvElement setGeneratorinfoname(string $generator_info_name)
 * @method \XMLTV\XmltvElement setGeneratorinfourl(string $generator_info_url)
 * @method \XMLTV\XmltvElement addChannel(array $attributes, string $value, callable $callback)
 * @method \XMLTV\XmltvElement addProgramme(array $attributes, string $value, callable $callback)
 */
class Xmltv
{
    /**
     * DTD informations constants.
     */
    const QUALIFIED_NAME = 'tv';
    const PUBLIC_ID = 'SYSTEM';
    const DTD = 'http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd';

    /**
     * @var \DomDocument
     */
    protected $_document;

    /**
     * @var XMLTV\Tv
     */
    protected $root;

    /**
     * Constructor.
     *
     * @param array $attributes: Attributes of the root tv element
     */
    public function __construct($attributes = [])
    {
        $this->_document = $this->_createDocument();
        $this->root = new Tv($this->_document, $attributes);

        $this->root->appendTo($this->_document);
    }

    /**
     * Validate the resulting xml against the externl DTD.
     *
     * @return boolean: True if the document is valid, false otherwise
     */
    public function validateDTD()
    {
        return $this->_document->validate();
    }

    /**
     * Output the result.
     *
     * @param bool $validateDTD: True to validate against the external DTD,
     *                           false otherwise (default).
     *
     * @return string: Valid XML
     *
     * Note that the internal validation is always run.
     */
    public function toXml($validateDTD = false)
    {
        if ($validateDTD) {
            $this->validateDTD();
        }

        $this->root->validate();

        return $this->_document->saveXml();
    }

    /**
     * Create the DomDocument instance.
     *
     * @return \DomDocument: The document
     */
    protected function _createDocument()
    {
        $implementation = new \DOMImplementation();
        $dtd = $implementation->createDocumentType(static::QUALIFIED_NAME, static::PUBLIC_ID, static::DTD);
        $document = $implementation->createDocument('', '', $dtd);

        $document->encoding = 'UTF-8';
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;

        return $document;
    }

    /**
     * Proxy to the root element.
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->root, $name], $arguments);
    }
}
