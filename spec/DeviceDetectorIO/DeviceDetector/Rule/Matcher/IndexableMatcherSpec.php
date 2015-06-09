<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Matcher;

use DeviceDetectorIO\DeviceDetector\Rule\Occurrence\Occurrences;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\OccurrencesAnalyserInterface;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder\FinderInterface;
use DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class IndexableMatcherSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Matcher
 */
class IndexableMatcherSpec extends ObjectBehavior
{
    public function let(FinderInterface $finder, OccurrencesAnalyserInterface $analyser)
    {
        $this->beConstructedWith($finder, $analyser);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Matcher\IndexableMatcher');
    }

    function it_implements_matcher_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Matcher\MatcherInterface');
    }

    function it_match_by_using_finder_and_analyser(FinderInterface $finder, OccurrencesAnalyserInterface $analyser, UserAgentTokenizedToken $token)
    {
        $iterator = new \SplObjectStorage();
        $occurences = new Occurrences();

        $analyser->analyse(Argument::exact($occurences))
            ->shouldBeCalled()
            ->willReturn($iterator);

        $finder->find($token)
            ->shouldBeCalled()
            ->willReturn($occurences);

        $this->match($token)->shouldReturn($iterator);
    }
}
