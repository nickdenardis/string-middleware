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
    $parser = new \Nickdenaris\ParserMiddleware();
    
    // Define the list of parsers to run, in chronological order
    $parsers = array(
        '/Nickdenardis/SelfParser', // Adhears to the ParserInterface
        '/Nickdenardis/ReverseParser',
    );
    
    // Set the stack of parsers
    $parser->setStack($parsers);
    
    // Parse the string and return the output
    $output = $parser->parse($input);
    
    // Output is now modified by each parser
    var_dump($ouput);
    
## Tests

    phpunit

## Code Coverage

    phpunit --coverage-html ./coverage