<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

class MobileVisitor extends AbstractUserAgentVisitor
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
    public function accept(TokenInterface $token, ContextInterface $context)
    {
        return parent::accept($token, $context) &&
            !$context->hasCapability(Capabilities::IS_ROBOT) || !$context->hasCapability(Capabilities::IS_SMART_TV);
    }

    /**
     * {@inheritdoc}
     */
    protected function doVisit(TokenInterface $token, ContextInterface $context)
    {
        $context->setCapability(Capabilities::IS_MOBILE, true);

        return VisitorInterface::STATE_SEEKING;
    }
} 