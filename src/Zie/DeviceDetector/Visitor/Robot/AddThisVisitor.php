<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AddThisVisitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class AddThisVisitor extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, $position)
    {
        if ($match) {
            $context->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, 'AddThis.com')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Clearspring Technologies, Inc.')
                ->setCapability(Capabilities::ROBOT_PRODUCER_URL, 'http://www.clearspring.com')
                ->setCapability(Capabilities::ROBOT_CATEGORY, Capabilities::ROBOT_CATEGORY_SOCIAL_MEDIA_AGENT);

            return VisitorInterface::STATE_FOUND;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @return string
     */
    protected function getPattern()
    {
        return 'AddThis.com';
    }
}
