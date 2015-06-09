<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Incrementation;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\OccurrenceInterface;

/**
 * Class Incrementation
 * @package DeviceDetectorIO\DeviceDetector\Rule\Incrementation
 */
class Incrementation implements IncrementationInterface
{
    /**
     * {@inheritdoc}
     */
    public function oughtToBeIncrement(OccurrenceInterface $current, OccurrenceInterface $previous)
    {
        $currentCondition = $current->getCondition();
        $currentNode = $current->getNode();
        $previousNode = $previous->getNode();

        if ($currentCondition->isStrategy(ConditionInterface::STRATEGY_NEXT)) {
            return 1 === $currentNode->getPosition() - $previousNode->getPosition();
        }

        return $currentNode->getPosition() > $previousNode->getPosition();
    }
}
