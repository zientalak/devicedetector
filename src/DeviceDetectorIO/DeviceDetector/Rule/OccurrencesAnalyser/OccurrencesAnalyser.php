<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser;

use DeviceDetectorIO\DeviceDetector\Rule\Incrementation\IncrementationInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrencesInterface;

/**
 * Class OccurrencesAnalyser.
 */
class OccurrencesAnalyser implements OccurrencesAnalyserInterface
{
    /**
     * @var IncrementationInterface
     */
    private $incrementation;

    /**
     * @var DynamicCapabilitiesProcessorInterface
     */
    private $dynamicCapabilitiesProcessor;

    /**
     * @param IncrementationInterface               $incrementation
     * @param DynamicCapabilitiesProcessorInterface $dynamicCapabilitiesProcessor
     */
    public function __construct(IncrementationInterface $incrementation, DynamicCapabilitiesProcessorInterface $dynamicCapabilitiesProcessor)
    {
        $this->incrementation = $incrementation;
        $this->dynamicCapabilitiesProcessor = $dynamicCapabilitiesProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function analyse(OccurrencesInterface $occurences)
    {
        $storage = new \SplObjectStorage();

        /** @var OccurrenceInterface $occurence */
        foreach ($occurences->getFirstOccurrences() as $occurence) {
            $rule = $occurence->getRule();
            $expectedCount = count($rule->getConditions());
            $counter = 1;

            $current = $occurence;
            $previous = null;

            $this->dynamicCapabilitiesProcessor->process($current);

            while ($next = $occurences->getNext($current)) {
                $previous = $current;
                $current = $next;

                if ($this->incrementation->oughtToBeIncrement($current, $previous)) {
                    ++$counter;
                    $this->dynamicCapabilitiesProcessor->process($current);
                }
            }

            if ($counter === $expectedCount && !$storage->contains($rule)) {
                $storage->attach($rule);
            }
        }

        return $storage;
    }
}
