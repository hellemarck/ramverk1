<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * test the IpController.
 */
class IpControllerTest extends TestCase
{
    // create variables for testing
    public $di;
    public $controllerTest;

    public function setUp()
    {
        // global $di;

        // di setup
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // init the test class
        $this->controllerTest = new IpController();
        $this->controllerTest->setDI($this->di);
    }

    /**
     * test the index route
     */
    public function testIndexAction()
    {
        $res = $this->controllerTest->indexAction();
        $this->assertIsObject($res);
    }

    /**
     * test the ip validation
     */
    public function testValidateIpAction()
    {
        // test ip4
        // $req = $this->di->get("request");
        $_GET["ipAdress"] = "127.0.0.1";
        $res = $this->controllerTest->validateIpAction();
        $this->assertIsObject($res);

        // test ip6
        $_GET["ipAdress"] = "2001:db8::8a2e:370:7334";
        $res = $this->controllerTest->validateIpAction();
        $this->assertIsObject($res);

        // test not valid IP
        $_GET["ipAdress"] = "1.2.3";
        $res = $this->controllerTest->validateIpAction();
        $this->assertIsObject($res);
    }
}
