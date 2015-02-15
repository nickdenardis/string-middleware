<?php namespace StringParser;

/**
 * Interface StringParserInterface
 * @package StringParser
 */
interface StringParserInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function parse($string);
}