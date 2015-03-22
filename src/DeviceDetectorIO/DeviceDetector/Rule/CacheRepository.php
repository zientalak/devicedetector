<?php

namespace DeviceDetectorIO\DeviceDetector\Rule;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;

/**
 * Class CacheRepository
 * @package DeviceDetectorIO\DeviceDetector\Rule
 */
class CacheRepository implements RuleRepositoryInterface
{
    /**
     * @var RuleRepositoryInterface
     */
    private $repository;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var string
     */
    private $cacheKey;

    /**
     * @var int
     */
    private $lifetime = CacheInterface::LIFETIME_DAY;

    /**
     * @param RuleRepositoryInterface $repository
     * @param CacheInterface $cache
     */
    public function __construct(RuleRepositoryInterface $repository, CacheInterface $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules()
    {
        if (empty($this->cacheKey)) {
            throw new \LogicException('Cache repository needs cache key.');
        }

        if ($this->cache->has($this->cacheKey)) {
            return unserialize($this->cache->get($this->cacheKey));
        }

        $rules = $this->repository->getRules();
        $this->cache->save(
            $this->cacheKey,
            serialize($rules),
            $this->lifetime
        );

        return $rules;
    }

    /**
     * @param string $cacheKey
     * @return self
     */
    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }

    /**
     * @param int $lifetime
     * @return self
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = (int)$lifetime;

        return $this;
    }
}
