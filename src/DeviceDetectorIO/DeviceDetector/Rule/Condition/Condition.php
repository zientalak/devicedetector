<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Condition;

/**
 * Class Condition
 * @package DeviceDetectorIO\DeviceDetector\Rule\Condition
 */
class Condition implements ConditionInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $strategy;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var array
     */
    protected $dynamicCapabilities = array();

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isType($type)
    {
        return $type === $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * {@inheritdoc}
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isStrategy($strategy)
    {
        return $strategy === $this->strategy;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($position)
    {
        $this->position = (int)$position;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function getDynamicCapabilities()
    {
        return $this->dynamicCapabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function setDynamicCapabilities(array $dynamicCapabilities)
    {
        $this->dynamicCapabilities = $dynamicCapabilities;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array(
            'type' => $this->type,
            'value' => $this->value,
            'strategy' => $this->strategy,
            'position' => $this->position,
            'dynamicCapabilities' => $this->dynamicCapabilities
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->type = $data['type'];
        $this->value = $data['value'];
        $this->strategy = $data['strategy'];
        $this->position = $data['position'];
        $this->dynamicCapabilities = $data['dynamicCapabilities'];
    }
}
