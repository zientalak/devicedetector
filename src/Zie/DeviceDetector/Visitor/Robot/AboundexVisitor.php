<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractMachVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AboundexVisitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class AboundexVisitor extends AbstractMachVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, $position)
    {
        if ($match) {
            $context->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, 'Aboundexbot')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Aboundex.com')
                ->setCapability(Capabilities::ROBOT_PRODUCER_URL, 'http://www.aboundex.com')
                ->setCapability(Capabilities::ROBOT_URL, 'http://www.aboundex.com/crawler/')
                ->setCapability(Capabilities::ROBOT_CATEGORY, Capabilities::ROBOT_CATEGORY_SEARCH_BOT);

            return VisitorInterface::STATE_FOUND;
        }

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @return string
     */
    protected function getPattern()
    {
        return 'Aboundex';
    }
}
