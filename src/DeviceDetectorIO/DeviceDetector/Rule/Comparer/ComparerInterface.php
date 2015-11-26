<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Comparer;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Interface ComparerInterface.
 */
interface ComparerInterface
{
    /**
     * @param NodeInterface      $node
     * @param ConditionInterface $condition
     *
     * @return bool
     */
    public function areEquals(NodeInterface $node, ConditionInterface $condition);
}
