<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Matcher;

use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesAnalyser\OccurrencesAnalyserInterface;
use DeviceDetectorIO\DeviceDetector\Rule\OccurrencesFinder\FinderInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class IndexableMatcher.
 */
class IndexableMatcher implements MatcherInterface
{
    /**
     * @var FinderInterface
     */
    private $finder;

    /**
     * @var OccurrencesAnalyserInterface
     */
    private $analyser;

    /**
     * @param FinderInterface              $finder
     * @param OccurrencesAnalyserInterface $analyser
     */
    public function __construct(FinderInterface $finder, OccurrencesAnalyserInterface $analyser)
    {
        $this->finder = $finder;
        $this->analyser = $analyser;
    }

    /**
     * {@inheritdoc}
     */
    public function match(TokenInterface $token)
    {
        return $this->analyser->analyse($this->finder->find($token));
    }
}
