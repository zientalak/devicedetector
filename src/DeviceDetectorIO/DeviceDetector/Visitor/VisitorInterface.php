<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Interface VisitorInterface.
 */
interface VisitorInterface
{
    const STATE_SEEKING = 0;
    const STATE_FOUND = 1;

    /**
     * @param TokenInterface    $token
     * @param CollatorInterface $collator
     *
     * @return bool
     */
    public function accept(TokenInterface $token, CollatorInterface $collator);

    /**
     * @param TokenInterface    $token
     * @param CollatorInterface $collator
     *
     * @return int
     */
    public function visit(TokenInterface $token, CollatorInterface $collator);
}
