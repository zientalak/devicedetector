<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Interface DynamicCapabilitiesProcessorInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser
 */
interface DynamicCapabilitiesProcessorInterface
{
    /**
     * @param OccurrenceInterface $occurrence
     * @return void
     */
    public function process(OccurrenceInterface $occurrence);
}
