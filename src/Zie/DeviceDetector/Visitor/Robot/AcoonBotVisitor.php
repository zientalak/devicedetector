<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AcoonBotVisitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class AcoonBotVisitor extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, $position)
    {
        if ($match) {
            $collector->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, 'Acoon')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Acoon GmbH')
                ->setCapability(Capabilities::ROBOT_PRODUCER_URL, 'http://www.acoon.de')
                ->setCapability(Capabilities::ROBOT_URL, 'http://www.acoon.de/robot.asp')
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
        return 'Acoon';
    }
}
