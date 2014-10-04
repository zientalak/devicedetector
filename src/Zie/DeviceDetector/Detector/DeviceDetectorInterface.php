<?php

namespace Zie\DeviceDetector\Detector;

/**
 * Interface DeviceDetectorInterface
 * @package Zie\DeviceDetector\Detector
 */
interface DeviceDetectorInterface
{
    /**
     * @return \Zie\DeviceDetector\Device\DeviceInterface
     */
    public function detect();
}
