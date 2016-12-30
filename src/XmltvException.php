<?php
namespace XMLTV;

/**
 * XMLTV exceptions
 *
 * @author
 *   Belkacem Alidra <dev@b-alidra.com>
 */
class XmltvException extends \Exception {
    const UNSUPPORTED_ATTRIBUTE_ERROR_CODE    = 2;
    const UNSUPPORTED_VALUE_ERROR_CODE        = 3;
    const UNSUPPORTED_CHILD_ERROR_CODE        = 4;
    const MISSING_ATTRIBUTE_ERROR_CODE        = 5;
    const MISSING_CHILD_ERROR_CODE            = 6;
    const MULTIPLE_ATTRIBUTE_ERROR_CODE       = 7;
    const MULTIPLE_CHILD_ERROR_CODE           = 8;
    const UNKNOWN_METHOD_ERROR_CODE           = 9;

    const UNSUPPORTED_ATTRIBUTE_ERROR_MESSAGE = "%s: Unsupported %s attribute";
    const UNSUPPORTED_VALUE_ERROR_MESSAGE     = "%s: Unsupported value.";
    const UNSUPPORTED_CHILD_ERROR_MESSAGE     = "%s: Unsupported %s child";
    const MISSING_ATTRIBUTE_ERROR_MESSAGE     = "%s: Missing %s attribute";
    const MISSING_CHILD_ERROR_MESSAGE         = "%s: Missing %s child";
    const MULTIPLE_ATTRIBUTE_ERROR_MESSAGE    = "%s: Multiple %s attribute";
    const MULTIPLE_CHILD_ERROR_MESSAGE        = "%s: Multiple %s children";
    const UNKNOWN_METHOD_ERROR_MESSAGE        = "%s: Call to undefined method %s";
}
