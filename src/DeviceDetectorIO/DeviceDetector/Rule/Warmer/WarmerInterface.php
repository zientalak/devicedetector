<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Warmer;

/**
 * Interface WarmerInterface
 * @package DeviceDetectorIO\DeviceDetector\Warmer
 */
interface WarmerInterface
{
    /**
     * Warmup rules.
     *
     * @return void
     */
    public function warmup();
}
