<?php
namespace Zie\DeviceDetector\Tests\TestCase;

use Zie\DeviceDetector\Collector\Collector;
use Zie\DeviceDetector\Visitor\VisitorInterface;

/**
 * Class VisitorTestCase
 * @package Zie\DeviceDetector\Tests\TestCase
 */
abstract class VisitorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return VisitorInterface
     */
    abstract protected function createVisitor();

    /**
     * @return Collector
     */
    protected function createCollector()
    {
        return new Collector();
    }
}
