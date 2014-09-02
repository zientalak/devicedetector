<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class LinuxVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class LinuxVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\LinuxVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11 (KHTML, like Gecko) Ubuntu/11.10 Chromium/17.0.963.65 Chrome/17.0.963.65 Safari/535.11';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertEquals(Capabilities::OS_FAMILY_LINUX, $context->getCapability(Capabilities::OS));
        $this->assertEquals(Capabilities::OS_FAMILY_LINUX, $context->getCapability(Capabilities::OS_FAMILY));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertFalse($context->getCapability(Capabilities::OS));
        $this->assertFalse($context->getCapability(Capabilities::OS_FAMILY));
    }
}