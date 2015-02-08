<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\SailfishJollaVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class SailfishJollaVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class SailfishJollaVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeSailfish()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Maemo; Linux; U; Jolla; Sailfish; Mobile; rv:26.0) Gecko/26.0 Firefox/26.0 SailfishBrowser/1.0 like Safari/538.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'SailfishJollaVisitor should return seeking status.'
        );

        $this->assertEquals(
            Capabilities::OS_SAILFISH,
            $collector->getCapability(Capabilities::OS),
            'SailfishJollaVisitor should set recognize Sailfish.'
        );

        $this->assertEquals(
            Capabilities::OS_FAMILY_LINUX,
            $collector->getCapability(Capabilities::OS_FAMILY),
            'SailfishJollaVisitor should set recognize Sailfish family.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new SailfishJollaVisitor();
    }
}
