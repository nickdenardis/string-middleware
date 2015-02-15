<?php namespace Nickdenardis\StringParser;

/**
 * Class ReverseParser
 */
class ReverseParser implements StringParserInterface
{
    /**
     * @param $string
     * @return mixed
     */
    public function parse($string) {
        return strrev($string);
    }
}