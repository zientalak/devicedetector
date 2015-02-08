<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Tests\Visitor\Android\AndroidBaseTest;
use Zie\DeviceDetector\Token\UserAgentToken;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AndroidCupcakeTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidCupcakeTest extends AndroidBaseTest
{
    /**
     * @test
     */
    public function recognizeAndoirdCupcake()
    {
        $collector = $this->createCollector();
        $visitor = $this->createVisitor();
        $token = new UserAgentToken(
            'Mozilla/5.0 (Linux; U; Android 1.5; sv-se; HTC Magic Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko)'
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
            '1.5',
            $collector->getCapability(Capabilities::OS_VERSION),
            'AndroidVisitor should set version properly.'
        );
        $this->assertSame(
            '1.5',
            $collector->getCapability(Capabilities::OS_VERSION_FULL),
            'AndroidVisitor should set full version properly.'
        );
        $this->assertSame(
            'Cupcake',
            $collector->getCapability(Capabilities::OS_RELEASE),
            'AndroidVisitor should recognize Cupcake release.'
        );
    }
}
