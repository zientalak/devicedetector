<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class MobileVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class MobileVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\MobileVisitor';

    public function testSuccess()
    {
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.3; en-us) AppleWebKit/999+ (KHTML, like Gecko) Safari/999.9';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_MOBILE));
        $this->assertTrue($context->getCapability(Capabilities::IS_MOBILE));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_MOBILE));
        $this->assertFalse($context->getCapability(Capabilities::IS_MOBILE));
    }
}