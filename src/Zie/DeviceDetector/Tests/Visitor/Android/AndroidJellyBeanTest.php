<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Tests\Visitor\Android\AndroidBaseTest;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\AndroidVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidJellyBeanTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidJellyBeanTest extends AndroidBaseTest
{
    /**
     * @test
     */
    public function recognizeAndoirdJellyBean()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 4.1.1; fr-fr; MB525 Build/JRO03H; CyanogenMod-10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidVisitor should return seeking status.'
        );
        $this->assertSame(
            Capabilities::OS_ANDROID,
            $collector->getCapability(Capabilities::OS),
            'AndroidVisitor should set Android OS.'
        );
        $this->assertSame(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::OS_VENDOR),
            'AndroidVisitor should set Google vendor.'
        );
        $this->assertSame(
            '4.1.1',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '4.1.1',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Jelly Bean',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Jelly Bean release.'
        );
    }

    /**
     * @test
     */
    public function recognizeAndoirFromdAdrUA()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'UCWEB/2.0 (Linux; U; Adr 4.2.2; en-US; Radius_RD51) U2/1.0.0 UCBrowser/8.2.0.242 U2/1.0.0 Mobile'
        );

        $this->assertSame(
            VisitorInterface::STATE_SEEKING,
            $visitor->visit($token, $collector),
            'AndroidVisitor should return seeking status.'
        );
        $this->assertSame(
            Capabilities::OS_ANDROID,
            $collector->getCapability(Capabilities::OS),
            'AndroidVisitor should set Android OS.'
        );
        $this->assertSame(
            Capabilities::VENDOR_GOOGLE,
            $collector->getCapability(Capabilities::OS_VENDOR),
            'AndroidVisitor should set Google vendor.'
        );
        $this->assertSame(
            '4.2.2',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '4.2.2',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Jelly Bean',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Jelly Bean release.'
        );
    }
}
