<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Comparer;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Interface ComparerInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Comparer
 */
interface ComparerInterface
{
    /**
     * @param NodeInterface $node
     * @param ConditionInterface $condition
     * @return boolean
     */
    public function areEquals(NodeInterface $node, ConditionInterface $condition);
}
