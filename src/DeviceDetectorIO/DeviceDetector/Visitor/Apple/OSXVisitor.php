<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\Apple;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor;

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
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        if (!$collector->hasCapability(Capabilities::OS) && preg_match($this->macPattern, $token->getData())) {

            $collector
                ->addCapability(Capabilities::OS, Capabilities::OS_OSX)
                ->addCapability(Capabilities::OS_VENDOR, Capabilities::VENDOR_APPLE)
                ->addCapability(Capabilities::OS_FAMILY, Capabilities::OS_FAMILY_UNIX);

            $matches = array();
            if (preg_match($this->osVersionPattern, $token->getData(), $matches)) {
                $collector->addCapability(Capabilities::OS_VERSION, $this->normalizeVersion($matches['version']));
            }
        }

        return self::STATE_SEEKING;
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