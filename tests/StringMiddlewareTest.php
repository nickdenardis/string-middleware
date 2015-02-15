<?php

use Nickdenardis\ParserMiddleware\ParserMiddleware;

/**
 * Class StringMiddlewareTest
 */
class StringMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Nickdenardis\ParserMiddleware\ParserMiddleware
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
     * @expectedException Nickdenardis\ParserMiddleware\InvalidStackException
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
     * @expectedException Nickdenardis\ParserMiddleware\InvalidParserException
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
     * @expectedException Nickdenardis\ParserMiddleware\InvalidParserException
     */
    public function handleNonParserParser() {
        // Define the parser stack items
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
    public function callStackSuccessfully() {
        $output = $this->parser->parse('foo');

        $this->assertEquals('foo', $output);
    }
}