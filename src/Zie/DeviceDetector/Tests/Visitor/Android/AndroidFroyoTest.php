<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Tests\Visitor\Android\AndroidBaseTest;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\AndroidVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidFroyoTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidFroyoTest extends AndroidBaseTest
{
    /**
     * @test
     */
    public function recognizeAndoirdFroyo()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 2.2.1; en-gb; HTC_DesireZ_A7272 Build/FRG83D) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1'
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
            '2.2.1',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '2.2.1',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Froyo',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Froyo release.'
        );
    }
}
