<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class RobotVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class RobotVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $position)
    {
        $collector->setCapability(Capabilities::IS_ROBOT, true);

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
