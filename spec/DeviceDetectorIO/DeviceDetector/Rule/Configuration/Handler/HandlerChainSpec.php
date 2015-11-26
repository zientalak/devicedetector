<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler;

use DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class HandlerChainSpec.
 */
class HandlerChainSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerChain');
    }

    public function it_implements_chain_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Handler\HandlerChainInterface');
    }

    public function it_add_handler(HandlerInterface $handler)
    {
        $this->addHandler($handler)->shouldReturn(true);
        $this->addHandler($handler)->shouldReturn(false);
    }

    public function it_has_handler(HandlerInterface $handler)
    {
        $this->hasHandler($handler)->shouldReturn(false);
        $this->addHandler($handler);
        $this->hasHandler($handler)->shouldReturn(true);
    }

    public function it_remove_handler(HandlerInterface $handler)
    {
        $this->addHandler($handler);
        $this->hasHandler($handler)->shouldReturn(true);
        $this->removeHandler($handler)->shouldReturn(true);
        $this->removeHandler($handler)->shouldReturn(false);
    }

    public function it_remove_all_handler(HandlerInterface $handler)
    {
        $this->addHandler($handler);
        $this->hasHandler($handler)->shouldReturn(true);
        $this->removeAll($handler)->shouldReturn(true);
        $this->hasHandler($handler)->shouldReturn(false);
    }

    public function it_return_handlers(HandlerInterface $handler)
    {
        $this->addHandler($handler);

        $handlers = $this->getHandlers();

        $handlers->shouldHaveCount(1);
        $handlers->shouldContain($handler);
    }

    public function it_handle_handlers(HandlerInterface $handler, RuleInterface $rule)
    {
        $configuration = [];

        $this->addHandler($handler);

        $handler->handle(Argument::exact($configuration), Argument::exact($rule->getWrappedObject()))
            ->shouldBeCalled();

        $this->handle($configuration, $rule);
    }
}
