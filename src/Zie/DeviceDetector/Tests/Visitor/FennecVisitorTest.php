<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class FennecVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class FennecVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\FennecVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0a1) Gecko/20110623 Firefox/7.0a1 Fennec/7.0a1';
        $context = $this->initTestSuccess($userAgent, array(Capabilities::IS_MOBILE => true));

        $this->assertEquals(Capabilities::BROWSER_FENNEC, $context->getCapability(Capabilities::BROWSER));
        $this->assertEquals('7', $context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertEquals('7.0a1', $context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertEquals(
            Capabilities::VENDOR_MOZILLA,
            $context->getCapability(Capabilities::BROWSER_VENDOR)
        );
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0';
        $context = $this->initTestFailure($userAgent, array(Capabilities::IS_MOBILE => true));

        $this->assertFalse($context->getCapability(Capabilities::BROWSER));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}
