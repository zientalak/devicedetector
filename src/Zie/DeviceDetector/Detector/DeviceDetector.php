<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Device\Device;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\TokenPoolInterface;
use Zie\DeviceDetector\VisitorManager\VisitorManagerInterface;

/**
 * Class DeviceDetector
 * @package Zie\DeviceDetector\Detector
 */
class DeviceDetector implements DeviceDetectorInterface
{
    /**
     * @var TokenPoolInterface
     */
    private $tokenPool;

    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @var VisitorManagerInterface
     */
    private $visitorManager;

    /**
     * @param VisitorManagerInterface $visitorManager
     * @param TokenPoolInterface $tokenPool
     * @param ContextInterface $context
     */
    public function __constructor(
        VisitorManagerInterface $visitorManager,
        TokenPoolInterface $tokenPool,
        ContextInterface $context
    ) {
        $this->visitorManager = $visitorManager;
        $this->tokenPool = $tokenPool;
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function detect()
    {
        $this->context->clear();

        $this->visitorManager->visit($this->tokenPool, $this->context);

        return new Device($this->context->getCapabilities());
    }
}
