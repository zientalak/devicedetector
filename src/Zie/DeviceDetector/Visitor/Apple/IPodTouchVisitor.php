<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPodTouchVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class IPodTouchVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $iPodPattern = '#iPod#is';

    /**
     * @var array
     */
    private $iPodVersions = array(
        'iPod1,1' => 'iPod touch',
        'iPod2,1' => 'iPod touch 2G',
        'iPod3,1' => 'iPod touch 3G',
        'iPod4,1' => 'iPod touch 4G',
        'iPod5,1' => 'iPod touch 5G'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        if (preg_match($this->iPodPattern, $token->getData())) {
            $context->setCapability(Capabilities::IS_OSX, false)
                ->setCapability(Capabilities::IS_IOS, true)
                ->setCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->setCapability(Capabilities::BRAND_NAME, 'iPod');

            foreach ($this->iPodVersions as $pattern => $name) {
                if (preg_match(sprintf('#%s#is', $pattern), $token->getData())) {
                    $context->setCapability(Capabilities::BRAND_NAME_FULL, $name);
                    break;
                }
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
