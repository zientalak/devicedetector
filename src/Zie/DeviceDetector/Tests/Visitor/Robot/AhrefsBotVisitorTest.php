<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\AhrefsBotVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AhrefsBotVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AhrefsBotVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAhrefsBot()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Ahrefs: (compatible; AhrefsBot/2.0; +http://ahrefs.com/robot/)'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'AhrefsBotVisitorTest should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'AhrefsBotVisitorTest should set recognize robot.'
        );

        $this->assertEquals(
            'aHrefs Bot',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'AhrefsBotVisitorTest should recognize name.'
        );

        $this->assertEquals(
            'Ahrefs Pte Ltd',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'AhrefsBotVisitorTest should recognize producer.'
        );

        $this->assertEquals(
            'http://ahrefs.com/robot',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER_URL),
            'AhrefsBotVisitorTest should recognize producer url.'
        );

        $this->assertEquals(
            'http://ahrefs.com/robot',
            $collector->getCapability(Capabilities::ROBOT_URL),
            'AhrefsBotVisitorTest should recognize url.'
        );

        $this->assertEquals(
            Capabilities::ROBOT_CATEGORY_CRAWLER,
            $collector->getCapability(Capabilities::ROBOT_CATEGORY),
            'AhrefsBotVisitorTest should recognize category.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AhrefsBotVisitor();
    }
}
