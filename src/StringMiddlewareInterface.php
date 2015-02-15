<?php namespace Nickdenardis\Stringmiddleware;

/**
 * Interface StringMiddlewareInterface
 * @package Nickdenardis\Stringmiddleware
 */
interface StringMiddlewareInterface
{
    public function stack(array $stack);
    public function parse($string);
}