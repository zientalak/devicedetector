<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Warmer;

use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader\LoaderInterface;
use DeviceDetectorIO\DeviceDetector\Rule\Collection\PriorityQueue;
use DeviceDetectorIO\DeviceDetector\Rule\Rule;

/**
 * Class AbstractWarmer
 * @package DeviceDetectorIO\DeviceDetector\Rule\Warmer
 */
abstract class AbstractWarmer implements WarmerInterface
{
    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @var HandlerInterface
     */
    private $handler;

    public function __construct(LoaderInterface $loader, HandlerInterface $handler)
    {
        $this->loader = $loader;
        $this->handler = $handler;
    }

    /**
     * @return PriorityQueue
     */
    protected function prepareRules()
    {
        $rules = new PriorityQueue();

        foreach ($this->loader->load() as $configuration) {
            $rule = new Rule();
            $this->handler->handle($configuration, $rule);

            $rules->insert($rule, $rule->getPriority());
        }

        return $rules;
    }
}
