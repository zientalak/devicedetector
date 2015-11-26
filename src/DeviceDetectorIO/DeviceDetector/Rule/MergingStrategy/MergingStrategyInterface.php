<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\MergingStrategy;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;

/**
 * Interface MergingStrategyInterface.
 */
interface MergingStrategyInterface
{
    /**
     * @param \Iterator         $rules
     * @param CollatorInterface $collator
     */
    public function merge(\Iterator $rules, CollatorInterface $collator);
}
