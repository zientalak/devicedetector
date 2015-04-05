<?php

namespace DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;

/**
 * Interface DeviceDetectorInterface
 * @package DeviceDetectorIO\DeviceDetector\Detector
 */
interface DeviceDetectorInterface
{
    /**
     * @param TokenPoolInterface $tokenPool
     * @return \DeviceDetectorIO\DeviceDetector\Device\DeviceInterface
     */
    public function detect(TokenPoolInterface $tokenPool);
}
