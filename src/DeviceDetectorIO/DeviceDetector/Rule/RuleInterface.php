<?php

namespace DeviceDetectorIO\DeviceDetector\Rule;

use DeviceDetectorIO\DeviceDetector\Rule\Condition\ConditionInterface;

/**
 * Interface RuleInterface.
 */
interface RuleInterface extends \Serializable
{
    /**
     * @return \Iterator<DeviceDetectorIO\DeviceDetector\Rule\ConditionInterface>
     */
    public function getConditions();

    /**
     * @param Condition\ConditionInterface $condition
     *
     * @return self
     */
    public function addCondition(ConditionInterface $condition);

    /**
     * @param Condition\ConditionInterface $condition
     *
     * @return bool
     */
    public function hasCondition(ConditionInterface $condition);

    /**
     * @param Condition\ConditionInterface $condition
     *
     * @return bool
     */
    public function removeCondition(ConditionInterface $condition);

    /**
     * @return bool
     */
    public function removeConditions();

    /**
     * @return int
     */
    public function getPriority();

    /**
     * @param int $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * @return array
     */
    public function getCapabilities();

    /**
     * @param array $capabilities
     *
     * @return self
     */
    public function setCapabilities(array $capabilities);

    /**
     * @return string
     */
    public function getCategory();

    /**
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category);
}
