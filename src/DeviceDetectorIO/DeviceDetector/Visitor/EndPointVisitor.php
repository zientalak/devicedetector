<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capabilities;
use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class EndPointVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class EndPointVisitor extends AbstractUserAgentTokenizedVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollatorInterface $collator)
    {
        $collator->set(
            Capabilities::IS_CONSOLE,
            !$this->hasEmptyCapability($collator, Capabilities::IS_CONSOLE)
        );

        $collator->set(
            Capabilities::IS_BOT,
            !$this->hasEmptyCapability($collator, Capabilities::IS_BOT)
        );

        $isMobile = $this->hasEmptyCapability($collator, Capabilities::IS_MOBILE);
        $collator->set(
            Capabilities::IS_DESKTOP,
            $isMobile
            && $this->hasEmptyCapability($collator, Capabilities::IS_BOT)
        );

        $collator->set(
            Capabilities::IS_MOBILE,
            !$isMobile
        );

        $collator->set(
            Capabilities::IS_SMART_TV,
            !$this->hasEmptyCapability($collator, Capabilities::IS_SMART_TV)
        );

        return self::STATE_SEEKING;
    }
    /**
     * @param CollatorInterface $collator
     * @param string $capability
     * @return bool
     */
    private function hasEmptyCapability(CollatorInterface $collator, $capability)
    {
        $result = $collator->get($capability);
        return empty($result);
    }
}
