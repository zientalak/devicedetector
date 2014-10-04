<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Capabilities;

/**
 * Class RobotVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class RobotVisitor extends AbstractDictionaryVisitor
{
    /**
     * @var array
     */
    protected $patterns = array(
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

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_ROBOT, $match);

        return VisitorInterface::STATE_FOUND;
    }
}
