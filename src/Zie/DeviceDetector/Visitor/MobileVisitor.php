<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class MobileVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class MobileVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $match, array $matches)
    {
        $collector->setCapability(Capabilities::IS_MOBILE, $match);

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * {@inheritdoc}
     */
    protected function getPatterns()
    {
        return array(
            'mobile',
            'mobi',
            'android',
            'up.browser',
            'phone',
            'opera mini',
            'opera mobi',
            'sonyericsson',
            'blackberry',
            'netfront',
            'uc browser',
            'symbian',
            'j2me',
            'wap2.',
            'up.link',
            'windows ce',
            'windows me',
            'vodafone',
            'ucweb',
            'ipad',
            'ipod',
            'docomo',
            'armv',
            'maemo',
            'palm',
            'bolt',
            'fennec',
            'wireless',
            'adr-',
            'zunewp7',
            'skyfire',
            'silk',
            'untrusted',
            'lgtelecom',
            ' gt-',
            'ventana',
            'tablet',
            'IEMobile',
            'tizen'
        );
    }
}
