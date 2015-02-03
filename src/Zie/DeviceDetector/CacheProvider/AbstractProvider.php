<?php

namespace Zie\DeviceDetector\CacheProvider;

/**
 * Class AbstractProvider
 * @package Zie\DeviceDetector\CacheProvider
 */
abstract class AbstractProvider implements CacheProviderInterface
{
    /**
     * @var string
     */
    protected $prefix = self::PREFIX;

    /**
     * @codeCoverageIgnore
     * @param string $prefix
     * @return self
     */
    public function setPrefix($prefix = self::PREFIX)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @param string $prefix
     * @param string $fingerprint
     * @return string
     */
    protected function generateKey($prefix, $fingerprint)
    {
        return sprintf('%s.%s', $prefix, $fingerprint);
    }
}
