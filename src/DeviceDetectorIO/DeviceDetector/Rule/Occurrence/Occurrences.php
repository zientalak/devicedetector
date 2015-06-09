<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

/**
 * Class Occurrences
 * @package DeviceDetectorIO\DeviceDetector\Rule\Occurrence
 */
class Occurrences implements OccurrencesInterface
{
    /**
     * @var array
     */
    private $occurrences = array();

    /**
     * {@inheritdoc}
     */
    public function getFirstOccurrences()
    {
        $firstOccurrences = new \SplObjectStorage();

        foreach ($this->occurrences as $occurrences) {
            foreach ($occurrences as $occurence) {
                if (0 === $occurence->getCondition()->getPosition()) {
                    $firstOccurrences->attach($occurence);
                }
            }
        }

        return $firstOccurrences;
    }

    /**
     * {@inheritdoc}
     */
    public function add(OccurrenceInterface $occurrence)
    {
        $rule = $occurrence->getRule();

        $this->occurrences[spl_object_hash($rule)][] = $occurrence;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->occurrences = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getNext(OccurrenceInterface $occurrence)
    {
        $rule = $occurrence->getRule();
        $condition = $occurrence->getCondition();
        $node = $occurrence->getNode();

        $nextConditionPosition = $condition->getPosition() + 1;
        $nextNodePosition = $node->getPosition() + 1;

        /** @var OccurrenceInterface $occurrence */
        foreach ($this->occurrences[spl_object_hash($rule)] as $occurrence) {
            $condition = $occurrence->getCondition();
            $node = $occurrence->getNode();

            if ($condition->getPosition() === $nextConditionPosition && $node->getPosition() >= $nextNodePosition) {
                return $occurrence;
            }
        }

        return false;
    }
}
