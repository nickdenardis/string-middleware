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
     * @throws InvalidParserException
     */
    public function parse($string) {
        // Loop through each parser
        while ($instance = $this->next()) {
            // Run the parse
            $string = $instance->run($string);
        }
        
        // Return the parsed output
        return $string;
    }

    /**
     * @return \Nickdenardis\StringParser\StringParserInterface
     * @throws InvalidParserException
     */
    private function next() {
        // Ensure there is a next parser
        if (!array_key_exists($this->position, $this->stack)) {
            return false;
        }

        // Ensure the class is callable
        if (!class_exists($this->stack[$this->position])) {
            throw new InvalidParserException('Parser "' . $this->stack[$this->position] . '" not found.');
        }

        // Return an instance of the stack item
        $instance = new $this->stack[$this->position];

        // Increment the parser position
        $this->position++;

        return $instance;
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