<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class BlinkBrowserEngineVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class BlinkBrowserEngineVisitor extends AbstractUserAgentTokenizedVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollatorInterface $collator)
    {
        if ($this->isWebkitBrowserEngine($collator)) {
            $blinkBrowsers = array(
                'chrome' => 28,
                'chromium' => 28,
                'opera' => 15
            );

            if (preg_match('#(?P<browser_name>chrome|chromium|opera)/(?P<browser_version>[^\s]+)#is', (string)$token, $matches)) {
                $browserName = strtolower($matches['browser_name']);
                if (isset($blinkBrowsers[$browserName]) && (float)$matches['browser_version'] >= $blinkBrowsers[$browserName]) {
                    $collator->set('browser_engine', 'Blink');
                }
            }
        }

        return self::STATE_SEEKING;
    }

    /**
     * @param CollatorInterface $collator
     * @return bool
     */
    private function isWebkitBrowserEngine(CollatorInterface $collator)
    {
        return strtolower($collator->get('browser_engine')) === 'webkit';
    }
}
