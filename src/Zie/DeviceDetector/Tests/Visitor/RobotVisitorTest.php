<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\RobotVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class RobotVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class RobotVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeRobot()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'SmartTVVisitorTest should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'SmartTVVisitorTest should recognize that is bot.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new RobotVisitor();
    }
}
