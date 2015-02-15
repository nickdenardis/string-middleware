# PHP String Manipulation Middleware

Plugin based string manipulator for PHP

[![Build Status](https://travis-ci.org/nickdenardis/string-middleware.svg)](https://travis-ci.org/nickdenardis/string-middleware)

## Installation

To install this library, run the command below and you will get the latest version

    composer require nickdenardis/string-middleware
    
## Usage

    // Start with some string
    $input = 'Some string to parse';

    // Create the instance of the Parser
    $parser = new ParserMiddleware\ParserMiddleware();
    
    // Define the list of parsers to run, in chronological order
    // Each must implement the 
    $parsers = array(
        'StringParser\SelfParser',
        'App\StringParsers\ReverseParser',
    );
    
    // Set the stack of parsers
    $parser->setStack($parsers);
    
    // Parse the string and return the output
    $output = $parser->parse($input);
    
    // Output is now modified by each parser
    var_dump($ouput);
    
## Example Parser

Reverse a string

    /**
     * Class ReverseParser
     */
    class ReverseParser implements StringParser\StringParserInterface
    {
        /**
         * @param string $string
         * @return string
         */
        public function parse($string) {
            return strrev($string);
        }
    }
    
## Tests

    phpunit

## Code Coverage

    phpunit --coverage-html ./coverage