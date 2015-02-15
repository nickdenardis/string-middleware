# PHP String Manipulation Middleware

Plugin based string manipulator

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
    // Each must implement the \StringParser\StringParserInterface
    $parsers = array(
        'StringParser\SelfParser',
        'App\StringParsers\ReverseParser',
    );
    
    // Set the stack of parsers
    $parser->setStack($parsers);
    
    // Parse the string and return the output
    $output = $parser->parse($input);
    
    // Output is now modified by each parser
    var_dump($output);
    
## Example Parser

Reverse a string

    /**
     * Class Header Parser
     */
    class HeaderParser implements \StringParser\StringParserInterface
    {
        /**
         * Replace every occurrence of "<p>[header ...]</p>" with "<h1>...</h1>"
         *
         * @param string $string
         * @return string
         */
        public function parse($string) {
            return preg_replace("/<p>\[header (.*)\]<\/p>/", '<h1>${1}</h1>', $string);
        }
    }
    
## Tests

    phpunit

## Code Coverage

    phpunit --coverage-html ./coverage
