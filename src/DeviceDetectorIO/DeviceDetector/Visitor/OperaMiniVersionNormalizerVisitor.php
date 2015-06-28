<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class OperaMiniVersionNormalizerVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class OperaMiniVersionNormalizerVisitor extends AbstractUserAgentTokenizedVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollatorInterface $collator)
    {
        if ($this->isOperaMiniBrowser($collator)) {
            $matches = array();
            if (preg_match('#opera mini/(?P<browser_version>[^\s;]+)#is', (string)$token, $matches)) {
                $collator->set('browser_version', $matches['browser_version']);
            }
        }

        return self::STATE_SEEKING;
    }

    /**
     * @param CollatorInterface $collator
     * @return bool
     */
    private function isOperaMiniBrowser(CollatorInterface $collator)
    {
        return strtolower($collator->get('browser_name')) === 'opera mini';
    }
}
