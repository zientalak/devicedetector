<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Interface TokenInterface
 * @package DeviceDetectorIO\DeviceDetector\Token
 */
interface TokenInterface extends \Serializable
{
    /**
     * @return mixed
     */
    public function getData();
}
