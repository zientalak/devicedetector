<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Incrementation;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Interface IncrementationInterface.
 */
interface IncrementationInterface
{
    /**
     * @param OccurrenceInterface $current
     * @param OccurrenceInterface $previous
     *
     * @return bool
     */
    public function oughtToBeIncrement(OccurrenceInterface $current, OccurrenceInterface $previous);
}
