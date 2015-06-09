<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;

/**
 * Class HandlerChain
 * @package DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler
 */
class HandlerChain implements HandlerChainInterface
{
    /**
     * @var array
     */
    private $handlers = array();

    /**
     * {@inheritdoc}
     */
    public function handle(array $configuration, RuleInterface $rule)
    {
        /** @var HandlerInterface $handler */
        foreach ($this->getHandlers() as $handler) {
            $handler->handle($configuration, $rule);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * {@inheritdoc}
     */
    public function addHandler(HandlerInterface $handler)
    {
        if (!$this->hasHandler($handler)) {
            $this->handlers[] = $handler;

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function hasHandler(HandlerInterface $handler)
    {
        return false !== array_search($handler, $this->handlers, true);
    }

    /**
     * {@inheritdoc}
     */
    public function removeHandler(HandlerInterface $handler)
    {
        $index = array_search($handler, $this->handlers, true);
        if (false !== $index) {
            unset($this->handlers[$index]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll()
    {
        $this->handlers = array();

        return true;
    }
}
