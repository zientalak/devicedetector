<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class WindowsVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class WindowsVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\WindowsVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::OS_WINDOWS, $context->getCapability(Capabilities::OS));
        $this->assertEquals('8', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals(Capabilities::VENDOR_MICROSOFT, $context->getCapability(Capabilities::OS_VENDOR));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::BROWSER));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VERSION_FULL));
        $this->assertFalse($context->getCapability(Capabilities::BROWSER_VENDOR));
    }
}