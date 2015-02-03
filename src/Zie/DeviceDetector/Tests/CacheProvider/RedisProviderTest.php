<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\RedisProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

/**
 * Class RedisProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class RedisProviderTest extends CacheProviderTestCase
{
    /**
     * @var \Redis
     */
    private $redis;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if (extension_loaded('redis')) {
            $this->redis = new \Redis();
            $ok = @$this->redis->connect('127.0.0.1');
            if (!$ok) {
                $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of redis');
            }
        } else {
            $this->markTestSkipped('The ' . __CLASS__ . ' requires the use of redis');
        }
    }

    public function tearDown()
    {
        if ($this->redis instanceof \redis) {
            $this->redis->flushDB();
        }
    }

    /**
     * @return RedisProvider
     */
    public function createCacheProvider()
    {
        return new RedisProvider($this->redis);
    }
}
