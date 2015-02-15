<?php namespace Nickdenardis\ParserMiddleware;

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

        // Set the stack
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
            $string = $instance->parse($string);
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
        if ($this->position >= count($this->stack)) {
            return false;
        }

        // Ensure the class is callable
        if (!class_exists($this->stack[$this->position])) {
            throw new InvalidParserException('Parser "' . $this->stack[$this->position] . '" not found.');
        }

        // Create an instance of the parser
        $instance = new $this->stack[$this->position];

        // Ensure the parser implemented the ParserInterface
        if (!in_array('Nickdenardis\\StringParser\\StringParserInterface', class_implements($instance))) {
            throw new InvalidParserException('Parser "' . $this->stack[$this->position] . '" not found.');
        }

        // Increment the parser position
        $this->position++;

        // Return an instance of the object
        return $instance;
    }
}