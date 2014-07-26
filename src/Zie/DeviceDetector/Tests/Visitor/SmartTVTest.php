<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class SmartTVTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class SmartTVTest extends VisitorTestCase
{
    protected $visitor = 'Zie\DeviceDetector\Visitor\SmartTVVisitor';

    /**
     * @return array
     */
    public function providerSuccess()
    {
        return array(
            array(
                'Mozilla/5.0 (X11; U: Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Large Screen Safari/533.4 GoogleTV/b39389',
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
                'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Safari/533.4',
                array()
            )
        );
    }

    /**
     * @param ContextInterface $context
     */
    public function postContextSuccess(ContextInterface $context)
    {
        $this->assertTrue($context->hasCapability(Capabilities::IS_SMART_TV));
        $this->assertTrue($context->getCapability(Capabilities::IS_SMART_TV));
    }

    /**
     * @param ContextInterface $context
     */
    public function postContextFailure(ContextInterface $context)
    {
        $this->assertTrue($context->hasCapability(Capabilities::IS_SMART_TV));
        $this->assertFalse($context->getCapability(Capabilities::IS_SMART_TV));
    }
}