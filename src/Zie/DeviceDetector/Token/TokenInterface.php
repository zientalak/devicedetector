<?php

namespace Zie\DeviceDetector\Token;

/**
 * Interface TokenInterface
 * @package Zie\DeviceDetector\Token
 */
interface TokenInterface extends \Serializable
{
    /**
     * @return mixed
     */
    public function getData();
}
