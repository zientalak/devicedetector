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

    /**
     * @test
     */
    public function whetherContextIsEmptyBeforeAddingAnyCapabilities()
    {
        $context = new Context();

        $this->assertCount(
            0,
            $context->getCapabilities(),
            'Context should be empty before adding any capabilities.'
        );
    }

    /**
     * @test
     */
    public function whetherContextSetCapability()
    {
        $context = new Context();

        $this->assertFalse(
            $context->hasCapability('capability1'),
            'Context should not contain capability before adding.'
        );
        $this->assertNull(
            $context->getCapability('capability1'),
            'Context should return null if capability not exists,'
        );

        $context->setCapability('capability1', 'capabilityValue');

        $this->assertTrue(
            $context->hasCapability('capability1'),
            'Context should contain capability after adding.'
        );
        $this->assertSame(
            'capabilityValue',
            $context->getCapability('capability1'),
            'Context should return expected value.'
        );
    }

    /**
     * @test
     */
    public function whetherContextSetCapabilities()
    {
        $capabilities = $this->getCapabilitiesData();

        $context = new Context();
        $context->setCapabilities($capabilities);

        $this->assertSame(
            $capabilities,
            $context->getCapabilities(),
            'Context should contain expected data.'
        );
        $this->assertSame(
            $capabilities['capability1'],
            $context->getCapability('capability1'),
            'Context should contain capability 1.'
        );
        $this->assertSame(
            $capabilities['capability2'],
            $context->getCapability('capability2'),
            'Context should contain capability 2.'
        );
        $this->assertSame(
            $capabilities['capability3'],
            $context->getCapability('capability3'),
            'Context should contain capability 3.'
        );
    }

    /**
     * @test
     */
    public function whetherContextClearWorksProperly()
    {
        $capabilities = $this->getCapabilitiesData();

        $context = new Context();
        $context->setCapabilities($capabilities);

        $this->assertGreaterThan(
            0,
            $context->getCapabilities(),
            'Context should contain capabilities after adding.'
        );

        $context->clear();

        $this->assertCount(
            0,
            $context->getCapabilities(),
            'Context should not contain capabilities after clearing.'
        );
    }

    /**
     * @test
     */
    public function whetherContextRemoveCapability()
    {
        $context = new Context();
        $context->setCapability('capability1', 'capabilityValue');

        $this->assertTrue(
            $context->hasCapability('capability1'),
            'Context should contain capability after adding and before removing.'
        );
        $this->assertSame(
            'capabilityValue',
            $context->getCapability('capability1'),
            'Context should return expected value before removing.'
        );

        $context->removeCapability('capability1');

        $this->assertFalse(
            $context->hasCapability('capability1'),
            'Context should not contain capability after removing.'
        );
        $this->assertNull(
            $context->getCapability('capability1'),
            'Context should return null if capability is removed.'
        );
    }
}
