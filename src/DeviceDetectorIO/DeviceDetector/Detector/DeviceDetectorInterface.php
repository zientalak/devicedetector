<?php

namespace DeviceDetectorIO\DeviceDetector\Detector;

/**
 * Interface DeviceDetectorInterface
 * @package DeviceDetectorIO\DeviceDetector\Detector
 */
interface DeviceDetectorInterface
{
    /**
     * @return \DeviceDetectorIO\DeviceDetector\Device\DeviceInterface
     */
    public function detect();
}
