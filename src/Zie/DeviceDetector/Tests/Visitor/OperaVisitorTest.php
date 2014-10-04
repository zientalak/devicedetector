<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class OperaVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class OperaVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\OperaVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; de) Opera 11.01';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::BROWSER_OPERA, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('11', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('11.01', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(Capabilities::VENDOR_OPERA, $context->getCapability(Capabilities::BROWSER_VENDOR));
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
