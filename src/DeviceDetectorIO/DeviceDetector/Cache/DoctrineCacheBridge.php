<?php

namespace DeviceDetectorIO\DeviceDetector\Cache;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\ClearableCache;

/**
 * Class DoctrineCacheBridge
 * @package DeviceDetectorIO\DeviceDetector\Cache
 */
class DoctrineCacheBridge implements CacheInterface
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        return $this->has($id) ? $this->cache->fetch($id) : false;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return $this->cache->contains($id);
    }

    /**
     * {@inheritdoc}
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return $this->cache->save($id, $data, $lifeTime);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return $this->cache->delete($id);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAll()
    {
        if ($this->cache instanceof ClearableCache) {
            return $this->cache->deleteAll();
        }

        return false;
    }
}
