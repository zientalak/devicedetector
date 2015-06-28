<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Repository;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;

/**
 * Class CacheRepository
 * @package DeviceDetectorIO\DeviceDetector\Rule\Repository
 */
class CacheRepository extends PHPRepository
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->namespace = get_class($this);
    }

    /**
     * @param string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return void
     * @throws \LogicException
     */
    protected function loadRules()
    {
        if ($this->loaded) {
            return;
        }

        if ($this->cache->has($this->namespace)) {
            $this->rules = $this->cache->get($this->namespace);
            $this->loaded = true;

            return;
        }

        parent::loadRules();
        $this->cache->save($this->namespace, serialize($this->rules));
    }
}
