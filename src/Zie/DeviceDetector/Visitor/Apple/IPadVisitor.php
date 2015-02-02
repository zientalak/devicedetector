<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class IPadVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class IPadVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $iPadPattern = '#iPad#is';

    /**
     * @var array
     */
    private $iPadVersions = array(
        'iPad1,1' => 'iPad',
        'iPad2,1' => 'iPad 2',
        'iPad2,2' => 'iPad 2',
        'iPad2,3' => 'iPad 2',
        'iPad2,4' => 'iPad 2',
        'iPad3,1' => 'iPad 3',
        'iPad3,2' => 'iPad 3',
        'iPad3,3' => 'iPad 3',
        'iPad3,4' => 'iPad 4',
        'iPad3,5' => 'iPad 4',
        'iPad3,6' => 'iPad 4',
        'iPad4,1' => 'iPad Air',
        'iPad4,2' => 'iPad Air',
        'iPad4,3' => 'iPad Air',
        'iPad5,3' => 'iPad Air 2',
        'iPad5,4' => 'iPad Air 2',
        'iPad2,5' => 'iPad mini 1G',
        'iPad2,6' => 'iPad mini 1G',
        'iPad2,7' => 'iPad mini 1G',
        'iPad4,4' => 'iPad mini 2',
        'iPad4,5' => 'iPad mini 2',
        'iPad4,6' => 'iPad mini 2',
        'iPad4,7' => 'iPad mini 3',
        'iPad4,8' => 'iPad mini 3',
        'iPad4,9' => 'iPad mini 3'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        if (preg_match($this->iPadPattern, $token->getData())) {
            $context->setCapability(Capabilities::IS_OSX, false)
                ->setCapability(Capabilities::IS_IOS, true)
                ->setCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->setCapability(Capabilities::BRAND_NAME, 'iPad');

            foreach ($this->iPadVersions as $pattern => $name) {
                if (preg_match(sprintf('#%s#is', $pattern), $token->getData())) {
                    $context->setCapability(Capabilities::BRAND_NAME_FULL, $name);
                    break;
                }
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
