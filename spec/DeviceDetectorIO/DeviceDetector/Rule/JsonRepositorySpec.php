<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\JsonRepository');
    }

    function it_implement_repository_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\RuleRepositoryInterface');
    }

    function it_return_rules()
    {
        $this->setFilePath(__DIR__ . '/../../../../resources/rules/json/basic.json')->shouldReturn($this);

        $this->getRules()->shouldBeArray();
        $this->getRules()->shouldHaveAtLeastOneRule();
    }

    function it_throw_exception()
    {
        $this->setFilePath(__DIR__ . '/../../../../resources/rules/json/basic2.json')->shouldReturn($this);

        $this->shouldThrow('\LogicException')
            ->during(
                'getRules'
            );
    }

    public function getMatchers()
    {
        return array(
            'haveAtLeastOneRule' => function ($subject) {
                return count($subject) > 0;
            },
        );
    }
}
