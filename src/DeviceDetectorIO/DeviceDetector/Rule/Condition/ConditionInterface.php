<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Condition;

/**
 * Interface ConditionInterface
 * @package DeviceDetectorIO\DeviceDetector\Rule\Condition
 */
interface ConditionInterface extends \Serializable
{
    const TYPE_TEXT = 'text';
    const TYPE_SPACE = 'space';
    const TYPE_PLACEHOLDER = 'placeholder';

    const TYPE_REGEX = 'regex';
    const TYPE_STRPOS = 'strpos';

    const STRATEGY_NEXT = 'next';
    const STRATEGY_LINE = 'line';

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     * @return self
     */
    public function setType($type);

    /**
     * @param string $type
     * @return boolean
     */
    public function isType($type);

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return self
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getStrategy();

    /**
     * @param string $strategy
     * @return self
     */
    public function setStrategy($strategy);

    /**
     * @param int $strategy
     * @return boolean
     */
    public function isStrategy($strategy);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     * @return self
     */
    public function setPosition($position);

    /**
     * @return array
     */
    public function getDynamicCapabilities();

    /**
     * @param array $dynamicCapabilities
     * @return self
     */
    public function setDynamicCapabilities(array $dynamicCapabilities);
}
