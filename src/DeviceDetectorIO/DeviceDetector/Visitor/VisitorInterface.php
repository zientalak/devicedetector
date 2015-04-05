<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface VisitorInterface
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
interface VisitorInterface
{
    const STATE_SEEKING = 0;
    const STATE_FOUND = 1;

    /**
     * @param TokenInterface $token
     * @param CollatorInterface $collator
     * @return boolean
     */
    public function accept(TokenInterface $token, CollatorInterface $collator);

    /**
     * @param TokenInterface $token
     * @param CollatorInterface $collator
     * @return integer
     */
    public function visit(TokenInterface $token, CollatorInterface $collator);
}
