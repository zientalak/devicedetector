<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class MobileVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class MobileVisitor extends AbstractDictionaryVisitor
{
    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, CollectorInterface $collector, $position)
    {
        $collector->addCapability(Capabilities::IS_MOBILE, true);

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
