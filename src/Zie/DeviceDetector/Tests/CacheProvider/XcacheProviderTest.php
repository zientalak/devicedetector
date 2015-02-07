<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\XcacheProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class XcacheProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class XcacheProviderTest extends CacheProviderTestCase
{
    /**
     * {@inheritdoc}
     * @see http://xcache.lighttpd.net/ticket/228
     */
    public function setUp()
    {
        if (!extension_loaded('xcache')) {
            $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of xcache');
        }

        $this->markTestSkipped('Xcache is not supported in CLI mode.');
    }

    /**
     * @return XcacheProvider
     */
    public function createCacheProvider()
    {
        return new XcacheProvider();
    }
}
