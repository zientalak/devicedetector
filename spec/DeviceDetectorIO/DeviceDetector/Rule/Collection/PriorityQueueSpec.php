<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Collection;

use PhpSpec\ObjectBehavior;

/**
 * Class PriorityQueueSpec.
 */
class PriorityQueueSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Collection\PriorityQueue');
    }

    public function it_prioritize_items()
    {
        $items = [-255, 2, 3, 255, 5, -1, 5];

        foreach ($items as $item) {
            $this->insert($item, $item);
        }

        foreach ([255, 5, 5, 3, 2, -1, -255] as $expected) {
            $this->extract()->shouldReturn($expected);
        };
    }
}
