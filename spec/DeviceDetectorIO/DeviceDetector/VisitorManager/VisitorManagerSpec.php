<?php

namespace spec\DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VisitorManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManager');
    }

    function it_implement_visitor_manager_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManagerInterface');
    }

    function it_add_visitor(VisitorInterface $visitor)
    {
        $this->hasVisitor($visitor)->shouldReturn(false);
        $this->addVisitor($visitor)->shouldReturn($this);
        $this->hasVisitor($visitor)->shouldReturn(true);
    }

    function it_remove_visitor(VisitorInterface $visitor)
    {
        $this->addVisitor($visitor)->shouldReturn($this);
        $this->hasVisitor($visitor)->shouldReturn(true);
        $this->removeVisitor($visitor)->shouldReturn($this);
        $this->hasVisitor($visitor)->shouldReturn(false);
    }

    function it_add_visitor_once(VisitorInterface $visitor)
    {
        $this->addVisitor($visitor)->shouldReturn($this);
        $this->addVisitor($visitor)->shouldReturn($this);

        $this->getVisitors()->shouldReturn(array($visitor));
    }

    function it_clear_visitors(VisitorInterface $visitor)
    {
        $this->addVisitor($visitor)->shouldReturn($this);
        $this->hasVisitor($visitor)->shouldReturn(true);

        $this->clear()->shouldReturn($this);

        $this->hasVisitor($visitor)->shouldReturn(false);
    }

    function it_get_prioritize_visitors(VisitorInterface $visitor1, VisitorInterface $visitor2, VisitorInterface $visitor3)
    {
        $this->addVisitor($visitor1, -255)->shouldReturn($this);
        $this->addVisitor($visitor2, 0)->shouldReturn($this);
        $this->addVisitor($visitor3, 255)->shouldReturn($this);

        $this->getVisitors()->shouldReturn(array(
            $visitor3,
            $visitor2,
            $visitor1
        ));
    }
}
