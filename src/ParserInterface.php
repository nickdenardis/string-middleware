<?php namespace Nickdenardis\ParserMiddleware;

/**
 * Interface StringParserInterface
 * @package Nickdenardis\Stringmiddleware
 */
interface StringParserInterface
{
    /**
     * @param $string
     * @return mixed
     */
    public function run($string);
}