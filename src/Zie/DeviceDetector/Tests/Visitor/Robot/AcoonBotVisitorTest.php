<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\AboundexVisitor;
use Zie\DeviceDetector\Visitor\Robot\AcoonBotVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AcoonBotVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AcoonBotVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAcoon()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (compatible; AcoonBot/4.12.1; +http://www.acoon.de/robot.asp))'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'AcoonVisitor should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'AcoonVisitor should set recognize robot.'
        );

        $this->assertEquals(
            'Acoon',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'AcoonVisitor should recognize name.'
        );

        $this->assertEquals(
            'Acoon GmbH',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'AcoonVisitor should recognize producer.'
        );

        $this->assertEquals(
            'http://www.acoon.de',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER_URL),
            'AcoonVisitor should recognize producer url.'
        );

        $this->assertEquals(
            'http://www.acoon.de/robot.asp',
            $collector->getCapability(Capabilities::ROBOT_URL),
            'AcoonVisitor should recognize url.'
        );

        $this->assertEquals(
            Capabilities::ROBOT_CATEGORY_SEARCH_BOT,
            $collector->getCapability(Capabilities::ROBOT_CATEGORY),
            'AcoonVisitor should recognize category.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AcoonBotVisitor();
    }
}
