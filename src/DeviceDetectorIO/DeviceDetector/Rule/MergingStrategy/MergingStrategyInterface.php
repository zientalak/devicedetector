<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;

/**
 * Interface MergingStrategyInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy
 */
interface MergingStrategyInterface
{
    /**
     * @param \Iterator $rules
     * @param CollatorInterface $collator
     * @return void
     */
    public function merge(\Iterator $rules, CollatorInterface $collator);
}
