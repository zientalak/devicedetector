<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class FirefoxVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class FirefoxVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\FirefoxVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:17.0) Gecko/20100101 Firefox/17.0.6';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_FIREFOX, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('17', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('17.0.6', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(Capabilities::BROWSER_VENDOR_MOZILLA, $context->getCapability(Capabilities::BROWSER_VENDOR));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}