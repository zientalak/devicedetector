<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\MemcachedProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class MemcachedProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class MemcachedProviderTest extends CacheProviderTestCase
{
    /**
     * @var \Memcached
     */
    private $memcached;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if (!extension_loaded('memcached')) {
            $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of memcached');
        }
        $this->memcached = new \Memcached();
        $this->memcached->setOption(\Memcached::OPT_COMPRESSION, false);
        $this->memcached->addServer('127.0.0.1', 11211);

        if (@fsockopen('127.0.0.1', 11211) === false) {
            unset($this->memcached);
            $this->markTestSkipped('The ' . __CLASS__ . ' cannot connect to memcache');
        }
    }

    public function tearDown()
    {
        if ($this->memcached instanceof \Memcached) {
            $this->memcached->flush();
        }
    }

    /**
     * @return MemcachedProvider
     */
    public function createCacheProvider()
    {
        return new MemcachedProvider($this->memcached);
    }
}
