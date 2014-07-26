<?php

namespace Zie\DeviceDetector\Tests\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;

/**
 * Class MobileTest
 * @package Zie\DeviceDetector\Tests\Visitor
 */
class MobileTest extends VisitorTestCase
{
    protected $visitor = 'Zie\DeviceDetector\Visitor\MobileVisitor';

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
        $this->assertTrue($context->hasCapability(Capabilities::IS_MOBILE));
        $this->assertTrue($context->getCapability(Capabilities::IS_MOBILE));
    }

    /**
     * @param ContextInterface $context
     */
    public function postContextFailure(ContextInterface $context)
    {
        $this->assertTrue($context->hasCapability(Capabilities::IS_MOBILE));
        $this->assertFalse($context->getCapability(Capabilities::IS_MOBILE));
    }
}