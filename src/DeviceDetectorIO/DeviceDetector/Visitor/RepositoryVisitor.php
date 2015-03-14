<?php

namespace DeviceDetectorIO\DeviceDetector\Visitor;

use DeviceDetectorIO\DeviceDetector\Collector\CollectorInterface;
use DeviceDetectorIO\DeviceDetector\MatchingStrategy\MatchingStrategyInterface;
use DeviceDetectorIO\DeviceDetector\Rule\RuleRepositoryInterface;
use DeviceDetectorIO\DeviceDetector\Token\TokenInterface;

/**
 * Class RepositoryVisitor
 * @package DeviceDetectorIO\DeviceDetector\Visitor
 */
class RepositoryVisitor implements VisitorInterface
{
    /**
     * @var RuleRepositoryInterface
     */
    private $repository;

    /**
     * @var MatchingStrategyInterface
     */
    private $strategy;

    /**
     * @param RuleRepositoryInterface $repository
     * @param MatchingStrategyInterface $strategy
     */
    public function __construct(RuleRepositoryInterface $repository, MatchingStrategyInterface $strategy)
    {
        $this->repository = $repository;
        $this->strategy = $strategy;
    }

    /**
     * {@inheritdoc}
     */
    public function accept(TokenInterface $token, CollectorInterface $collector)
    {
        return in_array(
            get_class($token),
            array(
                'DeviceDetectorIO\DeviceDetector\Token\UserAgentToken',
                'DeviceDetectorIO\DeviceDetector\Token\UserAgentTokenizedToken'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function visit(TokenInterface $token, CollectorInterface $collector)
    {
        foreach ($this->repository->getRules() as $rule) {
            $match = $this->strategy->match($rule, $token);
            if ($match) {
                $collector->mergeCapabilities($match);
            }
        }

        return self::STATE_SEEKING;
    }
}
