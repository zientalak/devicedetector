<?php

namespace DeviceDetectorIO\DeviceDetector\Rule;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;

/**
 * Class Rule.
 */
class Rule implements RuleInterface
{
    /**
     * @var \Iterator
     */
    protected $conditions;

    /**
     * @var int
     */
    protected $priority = 0;

    /**
     * @var array
     */
    protected $capabilities = [];

    /**
     * @var string
     */
    protected $category;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->conditions = new \SplObjectStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * {@inheritdoc}
     */
    public function addCondition(ConditionInterface $condition)
    {
        if (!$this->hasCondition($condition)) {
            $this->conditions->attach($condition);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCondition(ConditionInterface $condition)
    {
        return $this->conditions->contains($condition);
    }

    /**
     * {@inheritdoc}
     */
    public function removeCondition(ConditionInterface $condition)
    {
        if ($this->hasCondition($condition)) {
            $this->conditions->detach($condition);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeConditions()
    {
        $this->conditions->removeAll($this->conditions);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function setPriority($priority)
    {
        $this->priority = (int) $priority;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            'conditions' => $this->conditions,
            'priority' => $this->priority,
            'capabilities' => $this->capabilities,
            'category' => $this->category,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->conditions = $data['conditions'];
        $this->priority = $data['priority'];
        $this->capabilities = $data['capabilities'];
        $this->category = $data['category'];
    }
}
