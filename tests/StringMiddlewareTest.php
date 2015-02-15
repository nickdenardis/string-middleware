<?php

/**
 * Class StringMiddlewareTest
 */
class StringMiddlewareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    protected function setUp() {

    }

    /**
     * @test
     */
    public function initialTest()
    {
        $this->assertEquals('1', '1');
    }
}