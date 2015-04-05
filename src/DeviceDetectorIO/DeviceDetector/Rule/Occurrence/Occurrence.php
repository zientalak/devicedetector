<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Occurrence;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;

/**
 * Class Occurrence
 * @package DeviceDetectorIO\DeviceDetector\Rule\Occurrence
 */
class Occurrence implements OccurrenceInterface
{
    /**
     * @var RuleInterface
     */
    private $rule;

    /**
     * @var ConditionInterface
     */
    private $condition;

    /**
     * @var NodeInterface
     */
    private $node;

    /**
     * @param RuleInterface $rule
     * @param \DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface $condition
     * @param \DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface $node
     */
    public function __construct(
        RuleInterface $rule,
        ConditionInterface $condition,
        NodeInterface $node
    ) {
        $this->rule = $rule;
        $this->condition = $condition;
        $this->node = $node;
    }

    /**
     * {@inheritdoc}
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * {@inheritdoc}
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * {@inheritdoc}
     */
    public function getNode()
    {
        return $this->node;
    }
}
