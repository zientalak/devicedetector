<?php

namespace Zie\DeviceDetector\Visitor\Robot;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractPatternVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class AlexaCrawlerVisitor
 * @package Zie\DeviceDetector\Visitor\Robot
 */
class AlexaCrawlerVisitor extends AbstractPatternVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $context, $match, array $matches)
    {
        if ($match) {
            $context
                ->setCapability(Capabilities::IS_ROBOT, true)
                ->setCapability(Capabilities::ROBOT_NAME, 'Alexa Crawler')
                ->setCapability(Capabilities::ROBOT_PRODUCER, 'Alexa Internet')
                ->setCapability(
                    Capabilities::ROBOT_PRODUCER_URL,
                    'https://alexa.zendesk.com/hc/en-us/sections/200100794-Crawlers'
                )
                ->setCapability(Capabilities::ROBOT_URL, 'http://www.alexa.com')
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
        return '#ia_archiver|alexabot|verifybot#is';
    }
}
