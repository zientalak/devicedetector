<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

/**
 * Interface OccurrencesInterface.
 */
interface OccurrencesInterface
{
    /**
     * @return \Iterator
     */
    public function getFirstOccurrences();

    /**
     * @param OccurrenceInterface $occurrence
     *
     * @return self
     */
    public function add(OccurrenceInterface $occurrence);

    /**
     * @return self
     */
    public function clear();

    /**
     * @param OccurrenceInterface $occurrence
     *
     * @return OccurrenceInterface|false
     */
    public function getNext(OccurrenceInterface $occurrence);
}
