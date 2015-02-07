<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AhrefsBotVisitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class AhrefsBotVisitor extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, $position)
    {
        if ($match) {
            $context->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, 'aHrefs Bot')
                ->setCapability(Capabilities::ROBOT_URL, 'http://ahrefs.com/robot')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Ahrefs Pte Ltd')
                ->setCapability(Capabilities::ROBOT_PRODUCER_URL, 'http://ahrefs.com/robot')
                ->setCapability(Capabilities::ROBOT_CATEGORY, Capabilities::ROBOT_CATEGORY_CRAWLER);

            return VisitorInterface::STATE_FOUND;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @return string
     */
    protected function getPattern()
    {
        return 'AhrefsBot';
    }
}
