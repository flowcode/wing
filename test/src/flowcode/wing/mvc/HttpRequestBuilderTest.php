<?php

namespace flowcode\wing\mvc;

use flowcode\wing\mvc\HttpRequestBuilder;
use PHPUnit_Framework_TestCase;

/**
 * Test class for HttpRequestBuilder.
 * Generated by PHPUnit on 2012-10-14 at 17:35:21.
 */
class HttpRequestBuilderTest extends PHPUnit_Framework_TestCase {

    /**
     * @var HttpRequestBuilder
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new HttpRequestBuilder;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers flowcode\wing\mvc\HttpRequestBuilder::buildFromRequestUrl
     * @todo Implement testBuildFromRequestUrl().
     */
    public function testBuildFromRequestUrl_emptyUrl_returnDefaultControllerAndAction() {
        $requestUrl = "";
        $httpRequestInstance = $this->object->buildFromRequestUrl($requestUrl);

        $this->assertEquals("HomeController", $httpRequestInstance->getControllerClass());
    }

    /**
     * @covers flowcode\wing\mvc\HttpRequestBuilder::buildFromRequestUrl
     * @todo Implement testBuildFromRequestUrl().
     */
    public function testBuildFromRequestUrl_demoUrl_returnDemoController() {
        $requestUrl = "/demo/hello";
        $httpRequestInstance = $this->object->buildFromRequestUrl($requestUrl);

        $this->assertEquals("DemoController", $httpRequestInstance->getControllerClass());
        $this->assertEquals("hello", $httpRequestInstance->getAction());
    }

}

?>