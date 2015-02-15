<?php namespace Nickdenardis\ParserMiddleware;

/**
 * Class ReverseParser
 */
class ReverseParser implements StringParserInterface
{
    /**
     * @param $string
     * @return mixed
     */
    public function run($string) {
        return strrev($string);
    }
}