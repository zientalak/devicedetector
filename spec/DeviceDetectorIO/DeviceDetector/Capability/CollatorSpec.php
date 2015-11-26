<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Capability;

use PhpSpec\ObjectBehavior;

/**
 * Class CollectorSpec.
 */
class CollatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Capability\Collator');
    }

    public function it_implements_collector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface');
    }

    public function it_set_capability()
    {
        $this->has('capability1')->shouldReturn(false);
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->has('capability1')->shouldReturn(true);
    }

    public function it_get_capabilities()
    {
        $capabilities = [
            'capability1' => 'capability1',
            'capability2' => 'capability2',
        ];

        $this->getAll()->shouldReturn([]);
        $this->setAll($capabilities)->shouldReturn(true);
        $this->getAll()->shouldEqual($capabilities);
    }

    public function it_get_capability()
    {
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->get('capability1')->shouldReturn('capability1');
    }

    public function it_remove_capability()
    {
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->has('capability1')->shouldReturn(true);
        $this->remove('capability1')->shouldReturn(true);
        $this->remove('capability1')->shouldReturn(false);
    }

    public function it_clear_capability()
    {
        $capabilities = [
            'capability1' => 'capability1',
            'capability2' => 'capability2',
        ];

        $this->setAll($capabilities)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->getAll()->shouldEqual([]);
    }

    public function it_merge_capabilities()
    {
        $capabilities = [
            'capability1' => 'capability1',
            'capability2' => 'capability2',
        ];

        $this->setAll($capabilities);
        $this->getAll()->shouldEqual($capabilities);

        $capabilities = [
            'capability1' => 'capability123',
            'capability3' => 'capability3',
        ];

        $this->merge($capabilities)->shouldReturn(true);
        $this->getAll()->shouldEqual([
            'capability1' => 'capability123',
            'capability2' => 'capability2',
            'capability3' => 'capability3',
        ]);
    }
}
