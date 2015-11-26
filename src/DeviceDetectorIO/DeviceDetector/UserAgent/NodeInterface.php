<?php

namespace DeviceDetectorIO\DeviceDetector\UserAgent;

/**
 * Interface NodeInterface.
 */
interface NodeInterface extends \Serializable
{
    const TYPE_TEXT = 1;
    const TYPE_SPACE = 2;

    /**
     * @return string
     */
    public function getValue();

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @return int
     */
    public function getType();

    /**
     * @param int $type
     *
     * @return bool
     */
    public function isType($type);
}
