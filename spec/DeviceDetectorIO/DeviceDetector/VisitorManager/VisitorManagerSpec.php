<?php

namespace spec\DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
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

    function it_visit_visitors(VisitorInterface $visitor1, VisitorInterface $visitor2, TokenPoolInterface $tokenPool, TokenInterface $token, CollectorInterface $collector)
    {
        $tokenPool->getTokens()
            ->shouldBeCalledTimes(1)
            ->willReturn(array($token));

        $visitor1->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $visitor1->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldNotBeCalled();

        $visitor2->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $visitor2->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_SEEKING);

        $this->addVisitor($visitor1, -255)->shouldReturn($this);
        $this->addVisitor($visitor2, 0)->shouldReturn($this);

        $this->visit($tokenPool, $collector)->shouldReturn($this);
    }

    function it_break_visiting_on_certain_status(VisitorInterface $visitor, TokenPoolInterface $tokenPool, TokenInterface $token, CollectorInterface $collector)
    {
        $tokenPool->getTokens()
            ->shouldBeCalledTimes(1)
            ->willReturn(array($token));

        $visitor->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $visitor->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_FOUND);

        $this->addVisitor($visitor, -255)->shouldReturn($this);

        $this->visit($tokenPool, $collector)->shouldReturn($this);
    }

    function it_throw_exception_on_unknown_status(VisitorInterface $visitor, TokenPoolInterface $tokenPool, TokenInterface $token, CollectorInterface $collector)
    {
        $tokenPool->getTokens()
            ->shouldBeCalledTimes(1)
            ->willReturn(array($token));

        $visitor->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $visitor->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(5);

        $this->addVisitor($visitor, -255)->shouldReturn($this);

        $this
            ->shouldThrow('\DeviceDetectorIO\DeviceDetector\Exception\UnknownStateException')
            ->during('visit', array($tokenPool, $collector));
    }
}
