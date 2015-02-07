<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\Robot\AlexaCrawlerVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AlexaCrawlerVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AlexaCrawlerVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeAlexaCrawler()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'ia_archiver (+http://www.alexa.com/site/help/webmasters; crawler@alexa.com)'
        );

        $this->assertSame(
            VisitorInterface::STATE_FOUND,
            $visitor->visit($token, $collector),
            'AlexaCrawlerVisitor should return found status.'
        );

        $this->assertTrue(
            $collector->getCapability(Capabilities::IS_ROBOT),
            'AlexaCrawlerVisitor should set recognize robot.'
        );

        $this->assertEquals(
            'Alexa Crawler',
            $collector->getCapability(Capabilities::ROBOT_NAME),
            'AlexaCrawlerVisitor should recognize name.'
        );

        $this->assertEquals(
            'Alexa Internet',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER),
            'AlexaCrawlerVisitor should recognize producer.'
        );

        $this->assertEquals(
            'https://alexa.zendesk.com/hc/en-us/sections/200100794-Crawlers',
            $collector->getCapability(Capabilities::ROBOT_PRODUCER_URL),
            'AlexaCrawlerVisitor should recognize producer url.'
        );

        $this->assertEquals(
            'http://www.alexa.com',
            $collector->getCapability(Capabilities::ROBOT_URL),
            'AlexaCrawlerVisitor should recognize url.'
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
        return new AlexaCrawlerVisitor();
    }
}
