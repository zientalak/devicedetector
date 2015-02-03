<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class iPhoneVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class iPhoneVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $iPhonePattern = '#iPhone#is';

    /**
     * @var array
     */
    private $iPhoneVersions = array(
        'iPhone1,1' => 'iPhone',
        'iPhone1,2' => 'iPhone 3G',
        'iPhone2,1' => 'iPhone 3GS',
        'iPhone3,1' => 'iPhone 4',
        'iPhone3,2' => 'iPhone 4',
        'iPhone3,3' => 'iPhone 4',
        'iPhone4,1' => 'iPhone 4S',
        'iPhone5,1' => 'iPhone 5',
        'iPhone5,2' => 'iPhone 5',
        'iPhone5,3' => 'iPhone 5C',
        'iPhone5,4' => 'iPhone 5C',
        'iPhone6,1' => 'iPhone 5S',
        'iPhone6,2' => 'iPhone 5S',
        'iPhone7,2' => 'iPhone 6',
        'iPhone7,1' => 'iPhone 6 Plus'
    );

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        if (preg_match($this->iPhonePattern, $token->getData())) {
            $context->setCapability(Capabilities::IS_OSX, false)
                ->setCapability(Capabilities::IS_IOS, true)
                ->setCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->setCapability(Capabilities::BRAND_NAME, 'iPhone');

            foreach ($this->iPhoneVersions as $pattern => $name) {
                if (preg_match(sprintf('#%s#is', $pattern), $token->getData())) {
                    $context->setCapability(Capabilities::BRAND_NAME_FULL, $name);
                    break;
                }
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
}
