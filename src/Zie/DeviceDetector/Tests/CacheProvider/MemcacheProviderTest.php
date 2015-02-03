<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\MemcacheProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class MemcacheProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class MemcacheProviderTest extends CacheProviderTestCase
{
    /**
     * @var \Memcache
     */
    private $memcache;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if (!extension_loaded('memcache')) {
            $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of memcache');
        }

        $this->memcache = new \Memcache();

        if (@$this->memcache->connect('localhost', 11211) === false) {
            unset($this->memcache);
            $this->markTestSkipped('The ' . __CLASS__ . ' cannot connect to memcache');
        }
    }

    public function tearDown()
    {
        if ($this->memcache instanceof \Memcache) {
            $this->memcache->flush();
        }
    }

    /**
     * @return MemcacheProvider
     */
    public function createCacheProvider()
    {
        return new MemcacheProvider($this->memcache);
    }
}
