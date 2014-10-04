<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class ChromeVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class ChromeVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\ChromeVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_CHROME, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('32', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('32.0.1667.0', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(Capabilities::VENDOR_GOOGLE, $context->getCapability(Capabilities::BROWSER_VENDOR));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}
