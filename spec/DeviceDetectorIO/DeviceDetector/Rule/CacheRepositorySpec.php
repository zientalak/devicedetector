<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule;

use DeviceDetectorIO\DeviceDetector\Cache\CacheInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CacheRepositorySpec extends ObjectBehavior
{
    function let(RuleRepositoryInterface $repository, CacheInterface $cache)
    {
        $this->beConstructedWith($repository, $cache);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\CacheRepository');
    }

    function it_implement_repository_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\RuleRepositoryInterface');
    }

    function it_throw_exception_if_empty_cache_key()
    {
        $this->shouldThrow('\LogicException')->during('getRules');
    }

    function it_return_rules_from_cache(RuleRepositoryInterface $repository, CacheInterface $cache)
    {
        $cacheKey = sprintf('cache_key_%s', time());
        $rules = array(rand(0, 100));

        $cache->has(Argument::exact($cacheKey))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $cache->get(Argument::exact($cacheKey))
            ->shouldBeCalledTimes(1)
            ->willReturn(serialize($rules));

        $this->setCacheKey($cacheKey)->shouldReturn($this);
        $this->getRules()->shouldReturn($rules);
    }

    function it_return_rules_from_wrapped_repository_and_add_to_cache(
        RuleRepositoryInterface $repository,
        CacheInterface $cache
    ) {
        $cacheKey = sprintf('cache_key_%s', time());
        $rules = array(rand(0, 100));

        $cache->has(Argument::exact($cacheKey))
            ->shouldBeCalledTimes(1)
            ->willReturn(false);

        $cache->get(Argument::any())
            ->shouldNotBeCalled();

        $repository->getRules()
            ->shouldBeCalledTimes(1)
            ->willReturn($rules);

        $cache->save(
            Argument::exact($cacheKey),
            Argument::exact(
                serialize($rules)
            ),
            Argument::exact(
                3600
            ))
            ->shouldBeCalledTimes(1)
            ->willReturn(true);

        $this->setCacheKey($cacheKey)->shouldReturn($this);
        $this->setLifetime(3600)->shouldReturn($this);
        $this->getRules()->shouldReturn($rules);
    }
}
