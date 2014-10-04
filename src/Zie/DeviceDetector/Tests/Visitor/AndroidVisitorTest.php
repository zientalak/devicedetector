<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class AndroidVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\AndroidVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.3; en-us) AppleWebKit/999+ (KHTML, like Gecko) Safari/999.9';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::OS_ANDROID, $context->getCapability(Capabilities::OS));
        $this->assertEquals(Capabilities::VENDOR_GOOGLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals('2.3', $context->getCapability(Capabilities::OS_VERSION));
        $this->assertEquals('Gingerbread', $context->getCapability(Capabilities::OS_RELEASE));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::OS));
        $this->assertFalse($context->getCapability(Capabilities::OS_VENDOR));
        $this->assertFalse($context->getCapability(Capabilities::OS_VERSION));
        $this->assertFalse($context->getCapability(Capabilities::OS_RELEASE));
    }
}