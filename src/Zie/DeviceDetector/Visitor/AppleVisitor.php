<?php

namespace Zie\DeviceDetector\Visitor;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Context\ContextInterface;
use Zie\DeviceDetector\Exception\VisitorNotAcceptableException;
use Zie\DeviceDetector\Token\TokenInterface;

/**
 * Class AppleVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class AppleVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $devicesMobilePattern = '#(?P<brand_name>iPhone|iPod|iPad)#is';
    /**
     * @var string
     */
    private $devicesMacPattern = '#Macintosh#is';
    /**
     * @var string
     */
    private $deviceMacVersionPattern = '#Mac OS X (?P<version>[0-9_]+)#is';
    /**
     * @var string
     */
    private $deviceVersionPattern = '#(?P<version>[0-9_]+) like Mac OS X#is';

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, ContextInterface $context)
    {
        $this->visitApple($token, $context);
        $this->visitAppleMobile($token, $context);

        return VisitorInterface::STATE_SEEKING;
    }

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     */
    private function visitApple(TokenInterface $token, ContextInterface $context)
    {
        if (preg_match($this->devicesMacPattern, $token->getData())) {
            $context->setCapability(Capabilities::OS, Capabilities::OS_OSX)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_APPLE)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_UNIX);

            $matches = array();
            if (preg_match($this->deviceMacVersionPattern, $token->getData(), $matches)) {
                $context->setCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']));
            } else {
                $matches = array();
                if (preg_match($this->deviceVersionPattern, $token->getData(), $matches)) {
                    $context->setCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']));
                }
            }
        }
    }

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     */
    private function visitAppleMobile(TokenInterface $token, ContextInterface $context)
    {
        if ($context->hasCapability(Capabilities::OS_OSX)) {
            return;
        }

        $matches = array();
        if (preg_match($this->devicesMobilePattern, $token->getData(), $matches)) {
            $context->setCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_APPLE)
                ->setCapability(Capabilities::BRAND_NAME, $matches['brand_name'])
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_UNIX);

            $matches = array();
            if (preg_match($this->deviceMacVersionPattern, $token->getData(), $matches)) {
                $context->setCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']));
            } else {
                $matches = array();
                if (preg_match($this->deviceVersionPattern, $token->getData(), $matches)) {
                    $context->setCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']));
                }
            }
        }
    }


    /**
     * Return normalized version of OSX|iOS version.
     *
     * @param string $version
     * @return string
     */
    private function normalizeVersion($version)
    {
        return str_replace('_', '.', $version);
    }
}
