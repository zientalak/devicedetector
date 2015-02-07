<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\AboundexVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AboundexVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AboundexVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAboundex()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Aboundex/0.3 (http://www.aboundex.com/crawler/)'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'AboundexVisitor should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'AboundexVisitor should set recognize robot.'
        );

        $this->assertEquals(
            'Aboundexbot',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'AboundexVisitor should recognize name.'
        );

        $this->assertEquals(
            'Aboundex.com',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'AboundexVisitor should recognize producer.'
        );

        $this->assertEquals(
            'http://www.aboundex.com',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER_URL),
            'AboundexVisitor should recognize producer url.'
        );

        $this->assertEquals(
            'http://www.aboundex.com/crawler/',
            $collector->getCapability(Capabilities::ROBOT_URL),
            'AboundexVisitor should recognize url.'
        );

        $this->assertEquals(
            Capabilities::ROBOT_CATEGORY_SEARCH_BOT,
            $collector->getCapability(Capabilities::ROBOT_CATEGORY),
            'AboundexVisitor should recognize category.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AboundexVisitor();
    }
}
