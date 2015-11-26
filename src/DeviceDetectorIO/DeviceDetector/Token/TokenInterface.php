<?php

namespace DeviceDetectorIO\DeviceDetector\Token;

/**
 * Interface TokenInterface.
 */
interface TokenInterface extends \Serializable
{
    /**
     * @return mixed
     */
    public function getData();
}
