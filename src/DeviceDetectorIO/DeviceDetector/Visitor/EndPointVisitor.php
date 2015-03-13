<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class EndPointVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class EndPointVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        $collector->addCapability(
            Capabilities::IS_DESKTOP,
            $this->hasEmptyCapability($collector, Capabilities::IS_MOBILE)
        );

        $collector->addCapability(
            Capabilities::IS_SMART_TV,
            !$this->hasEmptyCapability($collector, Capabilities::IS_SMART_TV)
        );

        $collector->addCapability(
            Capabilities::IS_ROBOT,
            !$this->hasEmptyCapability($collector, Capabilities::IS_ROBOT)
        );

        return self::STATE_SEEKING;
    }

    /**
     * @param CollectorInterface $collector
     * @param string $capability
     * @return bool
     */
    private function hasEmptyCapability(CollectorInterface $collector, $capability)
    {
        $result = $collector->getCapability($capability);
        return empty($result);
    }
}
