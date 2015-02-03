<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\InMemoryProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class InMemoryProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class InMemoryProviderTest extends CacheProviderTestCase
{
    /**
     * @return InMemoryProvider
     */
    public function createCacheProvider()
    {
        return new InMemoryProvider();
    }
}
