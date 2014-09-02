<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class WindowsPhoneVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class WindowsPhoneVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $patternWindowsPhone = '#Windows Phone|NativeHost#is';

    /**
     * @var string
     */
    private $patternWindowsPhoneVersion = '#(Windows Phone|Windows Phone OS) (?P<version>[\d\.]+)#is';

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $userAgent = $token->getData();

        if (preg_match($this->patternWindowsPhone, $userAgent)) {
            $context->setCapability(Capabilities::OS, Capabilities::OS_WINDOWS_PHONE)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_MICROSOFT);

            $matches = array();
            if (preg_match($this->patternWindowsPhoneVersion, $userAgent, $matches)) {
                $context->setCapability(Capabilities::OS_VERSION, $matches['version']);
            }
        }

        return VisitorInterface::STATE_SEEKING;
    }
} 