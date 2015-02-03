<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\ApcProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class ApcProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class ApcProviderTest extends CacheProviderTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if (!extension_loaded('apc') || false === @apc_cache_info()) {
            $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of APC');
        }
    }

    /**
     * @return ApcProvider
     */
    public function createCacheProvider()
    {
        return new ApcProvider();
    }
}
