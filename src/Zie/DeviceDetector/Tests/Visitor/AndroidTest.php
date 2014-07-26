<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class AndroidTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class AndroidTest extends VisitorTestCase
{
    protected $visitor = 'Zie\DeviceDetector\Visitor\AndroidVisitor';

    /**
     * @return array
     */
    public function providerSuccess()
    {
        return array(
            array(
                'Mozilla/5.0 (Linux; U; Android 2.3; en-us) AppleWebKit/999+ (KHTML, like Gecko) Safari/999.9',
                array()
            )
        );
    }

    /**
     * @return array
     */
    public function providerFailure()
    {
        return array(
            array(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36',
                array()
            )
        );
    }

    /**
     * @param ContextInterface $context
     */
    public function postContextSuccess(ContextInterface $context)
    {
        $this->assertTrue($context->getCapability(Capabilities::IS_ANDROID));
        $this->assertEquals(Capabilities::OS_ANDROID, $context->getCapability(Capabilities::OS));
        $this->assertEquals(Capabilities::OS_VENDOR_GOOGLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertEquals('2.3', $context->getCapability(Capabilities::OS_VERSION));

    }

    /**
     * @param ContextInterface $context
     */
    public function postContextFailure(ContextInterface $context)
    {
        $this->assertFalse($context->getCapability(Capabilities::IS_ANDROID));
        $this->assertNotEquals(Capabilities::OS_ANDROID, $context->getCapability(Capabilities::OS));
        $this->assertNotEquals(Capabilities::OS_VENDOR_GOOGLE, $context->getCapability(Capabilities::OS_VENDOR));
        $this->assertNotEquals('2.3', $context->getCapability(Capabilities::OS_VERSION));
    }
}