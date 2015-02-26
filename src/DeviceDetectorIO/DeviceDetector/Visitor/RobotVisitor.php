<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class RobotVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class RobotVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $position)
    {
        $collector->addCapability(Capabilities::IS_ROBOT, true);

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPatterns()
    {
        return array(
            'bot',
            'crawler',
            'spider',
            'novarra',
            'transcoder',
            'yahoo! searchmonkey',
            'yahoo! slurp',
            'feedfetcher-google',
            'mowser',
            'mediapartners-google',
            'azureus',
            'inquisitor',
            'baiduspider',
            'baidumobaider',
            'holmes/',
            'libwww-perl',
            'netSprint',
            'yandex',
            'cfnetwork',
            'ineturl',
            'jakarta',
            'lorkyll',
            'microsoft url control',
            'indy library',
            'slurp',
            'crawl',
            'wget',
            'ucweblient',
            'snoopy',
            'untrursted',
            'mozfdsilla',
            'ask jeeves',
            'jeeves/teoma',
            'mechanize',
            'http client',
            'servicemonitor',
            'httpunit',
            'hatena',
            'ichiro',
            'feedly',
            'larbin',
            'zyborg'
        );
    }
}
