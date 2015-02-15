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
        while ($class_name = $this->next()) {

            // Run the parser
            $string = (new $class_name)->parse($string);

            // Increment the parser position
            $this->position++;
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

        // Get the next class name
        $class_name = $this->stack[$this->position];

        // Ensure the class is callable
        if (!class_exists($class_name)) {
            throw new InvalidParserException('Parser "' . $class_name . '" not found.');
        }

        // Ensure the parser implemented the ParserInterface
        if (!in_array('StringParser\\StringParserInterface', class_implements($class_name))) {
            throw new InvalidParserException('Parser "' . $class_name . '" not found.');
        }

        // Return the next class name
        return $class_name;
    }
}
