<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class SafariVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class SafariVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\SafariVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_SAFARI, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('6', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('6.0', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(Capabilities::VENDOR_APPLE, $context->getCapability(Capabilities::BROWSER_VENDOR));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}
