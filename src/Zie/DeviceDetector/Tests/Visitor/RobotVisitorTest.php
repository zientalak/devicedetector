<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class RobotVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class RobotVisitorTest extends VisitorTestCase
{
    /**
     * @var string
     */
    protected $visitor = 'Zie\DeviceDetector\Visitor\RobotVisitor';

    public function testSuccess()
    {
        $userAgent = 'Feedly/1.0 (+http://www.feedly.com/fetcher.html; like FeedFetcher-Google)';
        $context = $this->initTestSuccess($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_ROBOT));
        $this->assertTrue($context->getCapability(Capabilities::IS_ROBOT));
    }

    public function testFailure()
    {
        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Large Screen Safari/533.4';
        $context = $this->initTestFailure($userAgent, array());

        $this->assertTrue($context->hasCapability(Capabilities::IS_ROBOT));
        $this->assertFalse($context->getCapability(Capabilities::IS_ROBOT));
    }
}