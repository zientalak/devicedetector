<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\PredisProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;
use Predis\Redis;
use Predis\Connection\ConnectionException;

/**
 * Class PredisProviderTest
 * @package Zie\DeviceDetector\Tests\CacheProvider
 */
class PredisProviderTest extends CacheProviderTestCase
{
    /**
     * @var \Predis\Redis
     */
    private $predis;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->predis = new Redis();
        try {
            $this->predis->connect();
        } catch (ConnectionException $e) {
            $this->markTestSkipped('The ' . __CLASS__ .' requires the use of redis');
        }
    }

    public function tearDown()
    {
        if ($this->predis instanceof \Redis) {
            $this->predis->flushdb();
        }
    }

    /**
     * @return PredisProvider
     */
    public function createCacheProvider()
    {
        return new PredisProvider($this->predis);
    }
}
