<?php namespace Nickdenardis\ParserMiddleware;

use Nickdenardis\ParserMiddleware\InvalidStackException;

/**
 * Class ParserMiddleware
 */
class ParserMiddleware implements ParserMiddlewareInterface
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $stack = array();

    /**
     * @param array $stack
     * @return array
     * @throws InvalidStackException
     */
    public function setStack(array $stack) {
        // Ensure the stack is an array of strings
        foreach ($stack as $item) {
            if (!is_string($item)) {
                throw new InvalidStackException('Stack must contain an array of strings.');
            }
        }

        return $this->stack = $stack;
    }

    /**
     * @return array
     */
    public function getStack() {
        return $this->stack;
    }

    /**
     * @param $string
     * @return string
     */
    public function parse($string) {
        // TODO: Implement parse() method.
    }

    /**
     * @return string
     */
    public function next() {
        // TODO: Implement next() method.
    }

    /**
     * @return string
     */
    public function current() {
        // TODO: Implement current() method.
    }

    /**
     * @return string
     */
    public function previous() {
        // TODO: Implement previous() method.
    }
}