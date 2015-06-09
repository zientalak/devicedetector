<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Interface OccurrenceInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Occurrence
 */
interface OccurrenceInterface
{
    /**
     * @return RuleInterface
     */
    public function getRule();

    /**
     * @return ConditionInterface
     */
    public function getCondition();

    /**
     * @return NodeInterface
     */
    public function getNode();
}
