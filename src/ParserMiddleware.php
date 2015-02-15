<?php namespace ParserMiddleware;

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
     * @return null
     * @throws InvalidStackException
     */
    public function setStack(array $stack) {

        // Run through the stack
        foreach ($stack as $class_name) {

            // Ensure each item is just the class name string
            if (!is_string($class_name)) {
                throw new InvalidStackException('Stack must contain an array of class name strings. (Example: StringParser\ReverseParser)');
            }

            // Add the parser to the end of the stack
            array_push($this->stack, $class_name);
        }

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

            // Run the parser
            $string = $instance->parse($string);
        }

        // Return the parsed output
        return $string;
    }

    /**
     * @return StringParser\StringParserInterface
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
        if (!in_array('StringParser\\StringParserInterface', class_implements($instance))) {
            throw new InvalidParserException('Parser "' . $this->stack[$this->position] . '" not found.');
        }

        // Increment the parser position
        $this->position++;

        // Return an instance of the object
        return $instance;
    }
}