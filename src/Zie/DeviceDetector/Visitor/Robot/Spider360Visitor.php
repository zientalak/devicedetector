<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class Spider360Visitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class Spider360Visitor extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, $position)
    {
        if ($match) {
            $context->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, '360Spider')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Online Media Group, Inc.')
                ->setCapability(Capabilities::ROBOT_URL, 'http://www.so.com/help/help_3_2.html')
                ->setCapability(Capabilities::ROBOT_CATEGORY, Capabilities::ROBOT_CATEGORY_SEARCH_BOT);

            return VisitorInterface::STATE_FOUND;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPattern()
    {
        return '360Spider';
    }
}
