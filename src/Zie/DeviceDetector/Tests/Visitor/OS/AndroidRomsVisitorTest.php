<?php

namespace Zie\DeviceDetector\Tests\Visitor\OS;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\OS\AndroidRomsVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidRomsVisitorTest
 * @package Zie\DeviceDetector\Tests\Visitor\OS
 */
class AndroidRomsVisitorTest extends VisitorTestCase
{
    /**
     * @test
     */
    public function recognizeRazoDroiD()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.3.6(RazoDroiD); es-us; GT-S5830i Build/RazoDroiD v2.0 by (rajrocks)rishee) AppleWebKit/533.1 (KHTML like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidRomsVisitor should return seeking status.'
        );

        $this->assertEquals(
            'RazoDroiD',
            $collector->getCapability(Capabilities::OS_ROM),
            'AndroidRomsVisitor should set recognize RazoDroiD.'
        );

        $this->assertEquals(
            '2.0',
            $collector->getCapability(Capabilities::OS_ROM_VERSION),
            'AndroidRomsVisitor should set recognize RazoDroiD version.'
        );
    }

    /**
     * @test
     */
    public function recognizeMildWild()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; HTC Desire Build/GRI40; MildWild CM-5.1) AppleWebKit/533.1 (KHTML like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidRomsVisitor should return seeking status.'
        );

        $this->assertEquals(
            'MildWild',
            $collector->getCapability(Capabilities::OS_ROM),
            'AndroidRomsVisitor should set recognize MildWild.'
        );

        $this->assertEquals(
            '5.1',
            $collector->getCapability(Capabilities::OS_ROM_VERSION),
            'AndroidRomsVisitor should set recognize MildWild version.'
        );
    }

    /**
     * @test
     */
    public function recognizeMildWildWithoutVersion()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.3.7; nl-nl; MildWild for Desire Build/GWK 74 MildWild for Desire) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidRomsVisitor should return seeking status.'
        );

        $this->assertEquals(
            'MildWild',
            $collector->getCapability(Capabilities::OS_ROM),
            'AndroidRomsVisitor should set recognize MildWild.'
        );

        $this->assertNull(
            $collector->getCapability(Capabilities::OS_ROM_VERSION),
            'AndroidRomsVisitor should set recognize MildWild version.'
        );
    }

    /**
     * @test
     */
    public function recognizeCyanogenMod()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Touchpad Build/GRJ22; CyanogenMod-7.1.0) AppleWebKit/533.1 (KHTML like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidRomsVisitor should return seeking status.'
        );

        $this->assertEquals(
            'CyanogenMod',
            $collector->getCapability(Capabilities::OS_ROM),
            'AndroidRomsVisitor should set recognize CyanogenMod.'
        );

        $this->assertEquals(
            '7.1.0',
            $collector->getCapability(Capabilities::OS_ROM_VERSION),
            'AndroidRomsVisitor should set recognize CyanogenMod version.'
        );
    }

    /**
    * @test
    */
    public function recognizeMocorDroid()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 4.0.3; in-id; SPHS on Hsdroid Build/MocorDroid4.0.3) AppleWebKit/533.1 (KHTML like Gecko) Version/4.0 Mobile Safari/533.1'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidRomsVisitor should return seeking status.'
        );

        $this->assertEquals(
            'MocorDroid',
            $collector->getCapability(Capabilities::OS_ROM),
            'AndroidRomsVisitor should set recognize MocorDroid.'
        );

        $this->assertEquals(
            '4.0.3',
            $collector->getCapability(Capabilities::OS_ROM_VERSION),
            'AndroidRomsVisitor should set recognize MocorDroid version.'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AndroidRomsVisitor();
    }
}
