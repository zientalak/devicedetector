<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class MobileVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class MobileVisitor extends AbstractPatternMatchVisitor
{
    /**
     * @var array
     */
    protected $patterns = array(
        'midp',
        'mobile',
        'android',
        'samsung',
        'nokia',
        'up.browser',
        'phone',
        'opera mini',
        'opera mobi',
        'brew',
        'sonyericsson',
        'blackberry',
        'netfront',
        'uc browser',
        'symbian',
        'j2me',
        'wap2.',
        'up.link',
        ' arm;',
        'windows ce',
        'vodafone',
        'ucweb',
        'zte-',
        'ipad;',
        'docomo',
        'armv',
        'maemo',
        'palm',
        'bolt',
        'fennec',
        'wireless',
        'adr-',
        'htc',
        '; xbox',
        'nintendo',
        'zunewp7',
        'skyfire',
        'silk',
        'untrusted',
        'lgtelecom',
        ' gt-',
        'ventana',
    );

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context, $match, array $matches)
    {
        $context->setCapability(Capabilities::IS_MOBILE, $match);

        return VisitorInterface::STATE_SEEKING;
    }
} 