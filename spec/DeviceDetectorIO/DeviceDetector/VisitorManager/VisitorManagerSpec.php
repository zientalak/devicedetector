<?php

namespace spec\DeviceDetectorIO\DeviceDetector\VisitorManager;

use DeviceDetectorIO\DeviceDetector\Capability\CollatorInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenPoolInterface;
use DeviceDetectorIO\DeviceDetector\Visitor\VisitorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class VisitorManagerSpec.
 */
class VisitorManagerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManager');
    }

    public function it_implement_visitor_manager_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\VisitorManager\VisitorManagerInterface');
    }

    public function it_add_visitor(VisitorInterface $visitor)
    {
        $this->has($visitor)->shouldReturn(false);
        $this->add($visitor)->shouldReturn(true);
        $this->has($visitor)->shouldReturn(true);
    }

    public function it_remove_visitor(VisitorInterface $visitor)
    {
        $this->add($visitor)->shouldReturn(true);
        $this->has($visitor)->shouldReturn(true);
        $this->remove($visitor)->shouldReturn(true);
        $this->remove($visitor)->shouldReturn(false);
        $this->has($visitor)->shouldReturn(false);
    }

    public function it_add_visitor_once(VisitorInterface $visitor)
    {
        $this->add($visitor)->shouldReturn(true);
        $this->add($visitor)->shouldReturn(false);
        $this->getIterator()->shouldReturnAnInstanceOf('\Iterator');
    }

    public function it_remove_all_visitors(VisitorInterface $visitor)
    {
        $this->add($visitor)->shouldReturn(true);
        $this->has($visitor)->shouldReturn(true);
        $this->removeAll()->shouldReturn(true);
        $this->has($visitor)->shouldReturn(false);
    }

    public function it_get_prioritize_visitors(VisitorInterface $visitor1, VisitorInterface $visitor2, VisitorInterface $visitor3)
    {
        $this->add($visitor1, -255)->shouldReturn(true);
        $this->add($visitor2, 0)->shouldReturn(true);
        $this->add($visitor3, 255)->shouldReturn(true);

        $iterator = $this->getIterator();

        $iterator[0]->shouldReturn($visitor3);
        $iterator[1]->shouldReturn($visitor2);
        $iterator[2]->shouldReturn($visitor1);
    }

    public function it_visit_visitors(VisitorInterface $visitor1, VisitorInterface $visitor2, TokenPoolInterface $tokenPool, TokenInterface $token, CollatorInterface $collator)
    {
        $tokenPool->getIterator()
            ->shouldBeCalledTimes(2)
            ->willReturn(new \ArrayIterator([$token->getWrappedObject()]));

        $visitor1->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collator->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $visitor1->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collator->getWrappedObject()))
            ->shouldNotBeCalled();

        $visitor2->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collator->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $visitor2->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collator->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_SEEKING);

        $this->add($visitor1, -255)->shouldReturn(true);
        $this->add($visitor2, 0)->shouldReturn(true);
        $this->visit($tokenPool, $collator)->shouldReturn($this);
    }

    public function it_break_visiting_on_certain_status(VisitorInterface $visitor, TokenPoolInterface $tokenPool, TokenInterface $token, CollatorInterface $collector)
    {
        $tokenPool->getIterator()
            ->shouldBeCalledTimes(1)
            ->willReturn(new \ArrayIterator([$token->getWrappedObject()]));

        $visitor->accept(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $visitor->visit(Argument::exact($token->getWrappedObject()), Argument::exact($collector->getWrappedObject()))
            ->shouldBeCalledTimes(1)
            ->willReturn(VisitorInterface::STATE_FOUND);

        $this->add($visitor, -255)->shouldReturn(true);
        $this->visit($tokenPool, $collector)->shouldReturn($this);
    }
}
