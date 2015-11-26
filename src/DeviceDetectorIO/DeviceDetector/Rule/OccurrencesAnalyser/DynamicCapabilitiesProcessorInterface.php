<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Interface DynamicCapabilitiesProcessorInterface.
 */
interface DynamicCapabilitiesProcessorInterface
{
    /**
     * @param OccurrenceInterface $occurrence
     */
    public function process(OccurrenceInterface $occurrence);
}
