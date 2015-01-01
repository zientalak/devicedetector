<?php

namespace Zie\DeviceDetector\Detector;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Device\Device;
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
    protected $tokenPool;

    /**
     * @var ContextInterface
     */
    protected $context;

    /**
     * @var VisitorManagerInterface
     */
    protected $visitorManager;

    /**
     * @param VisitorManagerInterface $visitorManager
     * @param TokenPoolInterface $tokenPool
     * @param ContextInterface $context
     */
    public function __construct(
        VisitorManagerInterface $visitorManager,
        TokenPoolInterface $tokenPool,
        ContextInterface $context
    ) {
        $this->visitorManager = $visitorManager;
        $this->context = $context;
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
        $this->context->clear();

        $this->visitorManager->visit($this->tokenPool, $this->context);

        return new Device($this->context->getCapabilities());
    }
}
