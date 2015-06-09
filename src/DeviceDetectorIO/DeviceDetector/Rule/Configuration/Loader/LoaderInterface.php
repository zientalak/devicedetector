<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader;

/**
 * Interface LoaderInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader
 */
interface LoaderInterface
{
    /**
     * @return array
     */
    public function load();
}
