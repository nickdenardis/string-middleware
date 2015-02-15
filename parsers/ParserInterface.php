<?php namespace Nickdenardis\StringParser;

/**
 * Interface StringParserInterface
 * @package Nickdenardis\StringParser
 */
interface StringParserInterface
{
    /**
     * @param $string
     * @return mixed
     */
    public function run($string);
}