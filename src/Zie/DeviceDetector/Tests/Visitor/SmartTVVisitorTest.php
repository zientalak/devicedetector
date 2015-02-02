<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\SmartTVVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class SmartTVVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class SmartTVVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeIPad()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Large Screen Safari/533.4 GoogleTV/ 162671'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'SmartTVVisitorTest should return seeking status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_SMART_TV),
            'SmartTVVisitorTest should recognize Smart TV.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new SmartTVVisitor();
    }
}
