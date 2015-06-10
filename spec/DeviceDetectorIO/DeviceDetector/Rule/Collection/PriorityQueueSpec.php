<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Collection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PriorityQueueSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Collection
 */
class PriorityQueueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Collection\PriorityQueue');
    }

    function it_prioritize_items()
    {
        $items = array(-255, 2, 3, 255, 5, -1, 5);

        foreach ($items as $item) {
            $this->insert($item, $item);
        }

        foreach (array(255, 5, 5, 3, 2, -1, -255) as $expected) {
            $this->extract()->shouldReturn($expected);
        };
    }
}
