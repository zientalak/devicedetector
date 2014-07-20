<?php

namespace Zie\DeviceDetector\Tests\Context;

use Zie\DeviceDetector\Context\Context;

/**
 * Class ContextTest
 * @package Zie\DeviceDetector\Tests\Context
 */
class ContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    private function getCapabilitiesData()
    {
        return array(
            'capability1' => 'capability1Value',
            'capability2' => 'capability2Value',
            'capability3' => 'capability3Value',
        );
    }

    public function testContextMethods()
    {
        $capabilities = $this->getCapabilitiesData();

        $context = new Context();
        $context->setCapabilities($capabilities);

        $this->assertEquals($capabilities, $context->getCapabilities());
        $this->assertEquals($capabilities['capability1'], $context->getCapability('capability1'));
        $this->assertEquals($capabilities['capability2'], $context->getCapability('capability2'));
        $this->assertEquals($capabilities['capability3'], $context->getCapability('capability3'));

        $context->setCapability('capability4', 'capability4Value');
        $this->assertTrue($context->hasCapability('capability4'));
        $this->assertEquals('capability4Value', $context->getCapability('capability4'));

        $context->removeCapability('capability1');
        $this->assertFalse($context->hasCapability('capability1'));
        $this->assertEquals(false, $context->getCapability('capability1'));

        $context->clear();
        $this->assertCount(0, $context->getCapabilities());
    }
} 