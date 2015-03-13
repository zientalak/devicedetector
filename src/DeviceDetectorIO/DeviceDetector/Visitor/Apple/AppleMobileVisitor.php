<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor\Apple;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\AbstractUserAgentVisitor;

/**
 * Class AppleMobileVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor\Apple
 */
abstract class AppleMobileVisitor extends AbstractUserAgentVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        if (!$collector->hasCapability(Capabilities::OS)
            && preg_match($this->getDevicePattern(), $token->getData())) {

            $collector
                ->addCapability(Capabilities::IS_IOS, true)
                ->addCapability(Capabilities::OS, Capabilities::OS_IOS)
                ->addCapability(Capabilities::BRAND_NAME, $this->getBrandName());

            $versionPattern = sprintf(
                '#%s (OS )?(?J)(?P<version>[\d+\.\_\-]+)|(?P<version>[\d+\.\_\-]+) like Mac OS X#',
                $this->getBrandName()
            );

            $matches = array();
            if (preg_match($versionPattern, $token->getData(), $matches)) {
                if (isset($matches['version'])) {
                    $matches['version'] = preg_replace('#[^\d+\.]#', '.', $matches['version']);
                    $collector
                        ->addCapability(Capabilities::OS_VERSION, $matches['version']);
                }
            }

            foreach ($this->getDeviceVersionsPatterns() as $pattern => $name) {
                if (preg_match(sprintf('#%s#is', $pattern), $token->getData())) {
                    $collector->addCapability(Capabilities::BRAND_NAME_FULL, $name);
                    break;
                }
            }
        }

        return self::STATE_SEEKING;
    }

    /**
     * @return string
     */
    abstract protected function getDevicePattern();

    /**
     * @return array
     */
    abstract protected function getDeviceVersionsPatterns();

    /**
     * @return string
     */
    abstract protected function getBrandName();
}
