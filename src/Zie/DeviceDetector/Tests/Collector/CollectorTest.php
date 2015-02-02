<?php

namespace Zie\DeviceDetector\Tests\Collector;

use Zie\DeviceDetector\Collector\Collector;

/**
 * Class CollectorTest
 * @package Zie\DeviceDetector\Tests\Collector
 */
class CollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function whetherCollectorIsEmptyBeforeAddingAnyCapabilities()
    {
        $context = new Collector();

        $this->assertCount(
            0,
            $context->getCapabilities(),
            'Collector should be empty before adding any capabilities.'
        );
    }

    /**
     * @test
     */
    public function whetherCollectorSetCapability()
    {
        $context = new Collector();

        $this->assertFalse(
            $context->hasCapability('capability1'),
            'Collector should not contain capability before adding.'
        );
        $this->assertNull(
            $context->getCapability('capability1'),
            'Collector should return null if capability not exists,'
        );

        $context->setCapability('capability1', 'capabilityValue');

        $this->assertTrue(
            $context->hasCapability('capability1'),
            'Collector should contain capability after adding.'
        );
        $this->assertSame(
            'capabilityValue',
            $context->getCapability('capability1'),
            'Collector should return expected value.'
        );
    }

    /**
     * @test
     */
    public function whetherCollectorSetCapabilities()
    {
        $capabilities = $this->getCapabilitiesData();

        $context = new Collector();
        $context->setCapabilities($capabilities);

        $this->assertSame(
            $capabilities,
            $context->getCapabilities(),
            'Collector should contain expected data.'
        );
        $this->assertSame(
            $capabilities['capability1'],
            $context->getCapability('capability1'),
            'Collector should contain capability 1.'
        );
        $this->assertSame(
            $capabilities['capability2'],
            $context->getCapability('capability2'),
            'Collector should contain capability 2.'
        );
        $this->assertSame(
            $capabilities['capability3'],
            $context->getCapability('capability3'),
            'Collector should contain capability 3.'
        );
    }

    /**
     * @test
     */
    public function whetherCollectorClearCapabilities()
    {
        $capabilities = $this->getCapabilitiesData();

        $context = new Collector();
        $context->setCapabilities($capabilities);

        $this->assertGreaterThan(
            0,
            $context->getCapabilities(),
            'Collector should contain capabilities after adding.'
        );

        $context->clear();

        $this->assertCount(
            0,
            $context->getCapabilities(),
            'Collector should not contain capabilities after clearing.'
        );
    }

    /**
     * @test
     */
    public function whetherCollectorRemoveCapability()
    {
        $context = new Collector();
        $context->setCapability('capability1', 'capabilityValue');

        $this->assertTrue(
            $context->hasCapability('capability1'),
            'Collector should contain capability after adding and before removing.'
        );
        $this->assertSame(
            'capabilityValue',
            $context->getCapability('capability1'),
            'Collector should return expected value before removing.'
        );

        $context->removeCapability('capability1');

        $this->assertFalse(
            $context->hasCapability('capability1'),
            'Collector should not contain capability after removing.'
        );
        $this->assertNull(
            $context->getCapability('capability1'),
            'Collector should return null if capability is removed.'
        );
    }

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
}
