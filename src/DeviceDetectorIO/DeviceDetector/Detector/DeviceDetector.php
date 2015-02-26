<?php

namespace DeviceDetectorIO\DeviceDetector\Detector;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
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
     * @var TokenPoolInterface
     */
    protected $tokenPool;

    /**
     * @var CollectorInterface
     */
    protected $collector;

    /**
     * @var VisitorManagerInterface
     */
    protected $visitorManager;

    /**
     * @param VisitorManagerInterface $visitorManager
     * @param TokenPoolInterface $tokenPool
     * @param CollectorInterface $context
     */
    public function __construct(
        VisitorManagerInterface $visitorManager,
        TokenPoolInterface $tokenPool,
        CollectorInterface $context
    ) {
        $this->visitorManager = $visitorManager;
        $this->collector = $context;
        $this->setTokenPool($tokenPool);
    }

    /**
     * @param TokenPoolInterface $tokenPool
     * @return self
     */
    public function setTokenPool(TokenPoolInterface $tokenPool)
    {
        $this->tokenPool = $tokenPool;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function detect()
    {
        $this->collector->clear();

        $this->visitorManager->visit($this->tokenPool, $this->collector);

        return new Device($this->collector->getCapabilities());
    }
}
