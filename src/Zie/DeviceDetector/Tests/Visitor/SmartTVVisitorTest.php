<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class SmartTVVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class SmartTVVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\SmartTVVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (X11; U: Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Large Screen Safari/533.4 GoogleTV/b39389';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_SMART_TV));
        $this->assertTrue($context->getCapability(Capabilities::IS_SMART_TV));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Safari/533.4';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_SMART_TV));
        $this->assertFalse($context->getCapability(Capabilities::IS_SMART_TV));
    }
}
