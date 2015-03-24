<?php namespace Waynestate\StringParser;

/**
 * Class ReverseParser
 */
class ReverseParser implements StringParserInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function parse($string) {
        return strrev($string);
    }
}
