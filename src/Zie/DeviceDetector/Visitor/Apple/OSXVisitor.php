<?php

namespace Zie\DeviceDetector\Visitor\Apple;

use Zie\DeviceDetector\Capabilities;
use Zie\DeviceDetector\Collector\CollectorInterface;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Visitor\AbstractUserAgentVisitor;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class OSXVisitor
 * @package Zie\DeviceDetector\Visitor
 */
class OSXVisitor extends AbstractUserAgentVisitor
{
    /**
     * @var string
     */
    private $macPattern = '#Macintosh#is';
    /**
     * @var string
     */
    private $osVersionPattern = '#Mac OS X (?J)(?P<version>[0-9_]+)|(?P<version>[0-9_]+) like Mac OS X#is';

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $context)
    {
        if (preg_match($this->macPattern, $token->getData())) {
            $context->setCapability(Capabilities::OS, Capabilities::OS_OSX)
                ->setCapability(Capabilities::IS_OSX, true)
                ->setCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_APPLE)
                ->setCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_UNIX);

            $matches = array();
            if (preg_match($this->osVersionPattern, $token->getData(), $matches)) {
                $context->setCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']))
                    ->setCapability(Capabilities::OS_VERSION_FULL, $this->normalizeVersion($matches['version']));
            }
        }

        return VisitorInterface::STATE_SEEKING;
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
