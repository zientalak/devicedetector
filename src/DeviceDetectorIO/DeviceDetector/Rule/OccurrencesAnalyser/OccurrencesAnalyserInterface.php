<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrencesInterface;

/**
 * Interface OccurrencesAnalyserInterface.
 */
interface OccurrencesAnalyserInterface
{
    /**
     * @param OccurrencesInterface $occurences
     *
     * @return \Iterator
     */
    public function analyse(OccurrencesInterface $occurences);
}
