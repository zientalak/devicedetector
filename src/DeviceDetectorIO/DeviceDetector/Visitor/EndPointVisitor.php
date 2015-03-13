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
        $isMobile = $collector->getCapability(Capabilities::IS_MOBILE);
        $collector->addCapability(
            Capabilities::IS_DESKTOP,
            empty($isMobile)
        );

        $isSmartTV = $collector->getCapability(Capabilities::IS_SMART_TV);
        $collector->addCapability(
            Capabilities::IS_SMART_TV,
            !empty($isSmartTV)
        );

        $isRobot = $collector->getCapability(Capabilities::IS_ROBOT);
        $collector->addCapability(
            Capabilities::IS_ROBOT,
            !empty($isRobot)
        );

        return self::STATE_SEEKING;
    }
}
