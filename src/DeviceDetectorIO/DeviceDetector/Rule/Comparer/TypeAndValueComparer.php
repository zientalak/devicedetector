<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Comparer;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Class TypeAndValueComparer.
 */
class TypeAndValueComparer implements ComparerInterface
{
    /**
     * {@inheritdoc}
     */
    public function areEquals(NodeInterface $node, ConditionInterface $condition)
    {
        if ($node->isType(NodeInterface::TYPE_SPACE) && $condition->isType(ConditionInterface::TYPE_SPACE)) {
            return true;
        }

        if ($condition->isType(ConditionInterface::TYPE_PLACEHOLDER)) {
            return true;
        }

        if ($node->isType(NodeInterface::TYPE_TEXT) && !$condition->isType(ConditionInterface::TYPE_TEXT)) {
            return false;
        }

        return $node->getValue() === $condition->getValue();
    }
}
