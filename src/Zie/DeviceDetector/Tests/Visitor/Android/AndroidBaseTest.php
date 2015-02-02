<?php

namespace Zie\DeviceDetector\Tests\Visitor\Android;

use Zie\DeviceDetector\Tests\TestCase\VisitorTestCase;
use Zie\DeviceDetector\Visitor\OS\AndroidVisitor;

/**
 * Class AndroidBaseTest
 * @package Zie\DeviceDetector\Tests\Visitor\Android
 */
abstract class AndroidBaseTest extends VisitorTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function createVisitor()
    {
        return new AndroidVisitor();
    }
}
