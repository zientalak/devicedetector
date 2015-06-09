<?php

namespace DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Device\Device;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManagerInterface;

/**
 * Class DeviceDetector
 * @package DeviceDetectorIO\DeviceDetector\Detector
 */
class DeviceDetector implements DeviceDetectorInterface
{
    /**
     * @var CollatorInterface
     */
    protected $collator;

    /**
     * @var VisitorManagerInterface
     */
    protected $visitorManager;

    /**
     * @param VisitorManagerInterface $visitorManager
     * @param CollatorInterface $collator
     */
    public function __construct(
        VisitorManagerInterface $visitorManager,
        CollatorInterface $collator
    ) {
        $this->visitorManager = $visitorManager;
        $this->collator = $collator;
    }

    /**
     * {@inheritdoc}
     */
    public function detect(TokenPoolInterface $tokenPool)
    {
        $this->collator->removeAll();

        $this->visitorManager->visit($tokenPool, $this->collator);

        return new Device($this->collator->getAll());
    }
}
