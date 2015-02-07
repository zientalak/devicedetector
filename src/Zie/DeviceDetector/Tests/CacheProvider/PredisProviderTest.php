<?php

namespace Zie\DeviceDetector\Tests\CacheProvider;

use Zie\DeviceDetector\CacheProvider\PredisProvider;
use Zie\DeviceDetector\Tests\TestCase\CacheProviderTestCase;

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
        if(!class_exists('Predis\Redis')) {
            $this->markTestSkipped('The ' . __CLASS__ .' requires the use of predis/predis component.');
        }

        $this->predis = new \Predis\Redis();
        try {
            $this->predis->connect();
        } catch (\Predis\Connection\ConnectionException $e) {
            $this->markTestSkipped('The ' . __CLASS__ .' requires the use of redis');
        }
    }

    public function tearDown()
    {
        if ($this->predis instanceof \Predis\Redis) {
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
