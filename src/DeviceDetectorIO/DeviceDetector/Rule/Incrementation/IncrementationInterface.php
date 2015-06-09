<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Incrementation;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Interface IncrementationInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Incrementation
 */
interface IncrementationInterface
{
    /**
     * @param OccurrenceInterface $current
     * @param OccurrenceInterface $previous
     * @return boolean
     */
    public function oughtToBeIncrement(OccurrenceInterface $current, OccurrenceInterface $previous);
}
