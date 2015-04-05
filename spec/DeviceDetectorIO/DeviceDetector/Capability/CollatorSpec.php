<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Capability;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CollectorSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Capability
 */
class CollatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Capability\Collator');
    }

    function it_implements_collector_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface');
    }

    function it_set_capability()
    {
        $this->has('capability1')->shouldReturn(false);
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->has('capability1')->shouldReturn(true);
    }

    function it_get_capabilities()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->getAll()->shouldReturn(array());
        $this->setAll($capabilities)->shouldReturn(true);
        $this->getAll()->shouldEqual($capabilities);
    }

    function it_get_capability()
    {
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->get('capability1')->shouldReturn('capability1');
    }

    function it_remove_capability()
    {
        $this->set('capability1', 'capability1')->shouldReturn(true);
        $this->has('capability1')->shouldReturn(true);
        $this->remove('capability1')->shouldReturn(true);
        $this->remove('capability1')->shouldReturn(false);
    }

    function it_clear_capability()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->setAll($capabilities)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->getAll()->shouldEqual(array());
    }

    function it_merge_capabilities()
    {
        $capabilities = array(
            'capability1' => 'capability1',
            'capability2' => 'capability2'
        );

        $this->setAll($capabilities);
        $this->getAll()->shouldEqual($capabilities);

        $capabilities = array(
            'capability1' => 'capability123',
            'capability3' => 'capability3'
        );

        $this->merge($capabilities)->shouldReturn(true);
        $this->getAll()->shouldEqual(array(
            'capability1' => 'capability123',
            'capability2' => 'capability2',
            'capability3' => 'capability3'
        ));
    }
}
