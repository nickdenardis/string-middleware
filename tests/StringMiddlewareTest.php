<?php

use ParserMiddleware\ParserMiddleware;

/**
 * Class StringMiddlewareTest
 */
class StringMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ParserMiddleware\ParserMiddleware
     */
    protected $parser;

    /**
     * Setup
     */
    protected function setUp() {
        $this->parser = new ParserMiddleware();
    }

    /**
     * @test
     */
    public function initialEmptyStack() {
        // Get the initial stack
        $stack = $this->parser->getStack();

        // Ensure it has zero parsers
        $this->assertCount(0, $stack);
    }

    /**
     * @test
     */
    public function addArrayToStack() {
        // Define the parser stack items
        $parsers = array(
            'Namespace\Class',
            'Namespace\Class',
            'Namespace\Class',
        );

        // Set the parser stack
        $this->parser->setStack($parsers);

        // Get the current stack
        $stack = $this->parser->getStack();

        // Ensure it has zero parsers
        $this->assertCount(count($parsers), $stack);
    }

    /**
     * @test
     * @expectedException ParserMiddleware\InvalidStackException
     */
    public function addNonArrayToStack() {
        $parsers = array(
            array('something'),
            array('something else'),
        );

        // Set the parser stack
        $this->parser->setStack($parsers);
    }

    /**
     * @test
     * @expectedException ParserMiddleware\InvalidParserException
     */
    public function handleNonCallableParser() {
        // Define the parser stack items
        $parsers = array(
            'Foo\Bar',
        );

        // Set the parser stack
        $this->parser->setStack($parsers);

        // Parse the stack
        $this->parser->parse('foo');
    }

    /**
     * @test
     * @expectedException ParserMiddleware\InvalidParserException
     */
    public function handleNonParserParser() {
        // Define a stack with items that do not implement 'StringParser\StringParserInterface'
        $parsers = array(
            'Exception',
        );

        // Set the parser stack
        $this->parser->setStack($parsers);

        // Parse the stack
        $this->parser->parse('foo');
    }

    /**
     * @test
     */
    public function returnsSameStringWithoutParsers() {
        // Run the parser without setting a stack of parsers
        $output = $this->parser->parse('foo');

        // The output should equal the input
        $this->assertEquals('foo', $output);
    }

    /**
     * @test
     */
    public function parsersBeingCalledSuccessfully(){
        $parsers = array(
            'StringParser\ReverseParser',
        );

        $this->parser->setStack($parsers);

        // Ensure the stub was called
        $this->assertEquals('oof', $this->parser->parse('foo'));
    }

    /**
     * @test
     */
    public function multipleParsersBeingCalledSuccessfully(){
        $parsers = array(
            'StringParser\ReverseParser',
            'StringParser\ReverseParser',
        );

        $this->parser->setStack($parsers);

        // Ensure the stub was called
        $this->assertEquals('foo', $this->parser->parse('foo'));
    }
}
