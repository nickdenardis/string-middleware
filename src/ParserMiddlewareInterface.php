<?php namespace Nickdenardis\ParserMiddleware;

/**
 * Interface ParserMiddlewareInterface
 * @package Nickdenardis\ParserMiddleware
 */
interface ParserMiddlewareInterface
{
    /**
     * @param array $stack
     * @return bool
     */
    public function setStack(array $stack);

    /**
     * @return array
     */
    public function getStack();

    /**
     * @param $string
     * @return string
     */
    public function parse($string);
}