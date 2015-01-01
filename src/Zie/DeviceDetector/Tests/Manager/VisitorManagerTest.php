<?php

namespace Zie\DeviceDetector\Tests\Manager;

use Zie\DeviceDetector\Context\Context;
use Zie\DeviceDetector\Exception\UnknownStateException;
use Zie\DeviceDetector\Token\TokenInterface;
use Zie\DeviceDetector\Token\TokenPool;
use Zie\DeviceDetector\Visitor\VisitorInterface;
use Zie\DeviceDetector\VisitorManager\VisitorManager;

/**
 * Class VisitorManagerTest
 * @package Zie\DeviceDetector\Tests\Manager
 */
class VisitorManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function visitorsShouldBeReturnedByPriority()
    {
        $visitor1 = $this->createVisitor(0, true, 0);
        $visitor2 = $this->createVisitor(0, true, 0);
        $visitor3 = $this->createVisitor(0, true, 0);
        $visitor4 = $this->createVisitor(0, true, 0);
        $visitor5 = $this->createVisitor(0, true, 0);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1, 0);
        $visitorManager->addVisitor($visitor2, 0);
        $visitorManager->addVisitor($visitor3, 10);
        $visitorManager->addVisitor($visitor4, 1);
        $visitorManager->addVisitor($visitor5, -100);

        $visitors = $visitorManager->getVisitors();

        $this->assertSame(
            $visitor3,
            $visitors[0],
            'Visitor 3 should be 1.'
        );

        $this->assertSame(
            $visitor4,
            $visitors[1],
            'Visitor 4 should be 2.'
        );

        $this->assertSame(
            $visitor1,
            $visitors[2],
            'Visitor 1 should be 3.'
        );

        $this->assertSame(
            $visitor2,
            $visitors[3],
            'Visitor 2 should be 4.'
        );

        $this->assertSame(
            $visitor5,
            $visitors[4],
            'Visitor 5 should be 5.'
        );
    }

    /**
     * @test
     */
    public function visitorsShouldBeAddedOnce()
    {
        $visitor1 = $this->createVisitor(0, true, 0);
        $visitor2 = $this->createVisitor(0, true, 0);
        $visitor3 = $this->createVisitor(0, true, 0);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);

        // again add same visitors
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);

        $this->assertCount(
            3,
            $visitorManager->getVisitors(),
            'Expected numbers of visitors is 3.'
        );
    }

    /**
     * @test
     */
    public function managerShouldNotContainVisitorsAfterClearing()
    {
        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($this->createVisitor(0, true, 0));

        $this->assertCount(
            1,
            $visitorManager->getVisitors(),
            'Expected numbers of visitors is 1.'
        );

        $visitorManager->clear();

        $this->assertCount(
            0,
            $visitorManager->getVisitors(),
            'After clearing manager should not contain any visitor.'
        );
    }

    /**
     * @test
     */
    public function visitorShouldBeProperlyAdded()
    {
        $visitor1 = $this->createVisitor(0, true, 0);

        $visitorManager = new VisitorManager();

        $this->assertFalse(
            $visitorManager->hasVisitor($visitor1),
            'Manager should not contain visitor that was never added.'
        );

        $visitorManager->addVisitor($visitor1);

        $this->assertTrue(
            $visitorManager->hasVisitor($visitor1),
            'Manager should contain visitor after adding.'
        );
    }

    /**
     * @test
     */
    public function visitorShouldBeProperlyRemoved()
    {
        $visitor1 = $this->createVisitor(0, true, 0);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->removeVisitor($visitor1);

        $this->assertFalse(
            $visitorManager->hasVisitor($visitor1),
            'Manager should not contain visitor that was never removed.'
        );
    }

    /**
     * @test
     */
    public function visitShouldBeCalledOnVisitorOnAcceptableToken()
    {
        $context = new Context();

        $token1 = $this->createToken('TokenMock1');

        $tokenPool = $this->createTokenPool();
        $tokenPool->addToken($token1);

        $visitor1 = $this->createVisitor(1, true, 1, VisitorInterface::STATE_SEEKING);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);

        $visitorManager->visit($tokenPool, $context);
    }

    /**
     * @test
     */
    public function visitShouldNotBeCalledIfOnNotAcceptableToken()
    {
        $context = new Context();

        $token1 = $this->createToken('TokenMock1');
        $token2 = $this->createToken('TokenMock1');

        $tokenPool = $this->createTokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $visitor1 = $this->createVisitor(2, false, 0, VisitorInterface::STATE_SEEKING);
        $visitor2 = $this->createVisitor(2, true, 2, VisitorInterface::STATE_SEEKING);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);

        $visitorManager->visit($tokenPool, $context);
    }

    /**
     * @test
     */
    public function visitShouldBeReturnedIfVisitorReturnFound()
    {
        $context = new Context();

        $token1 = $this->createToken('TokenMock1');
        $token2 = $this->createToken('TokenMock1');

        $tokenPool = $this->createTokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $visitor1 = $this->createVisitor(1, true, 1, VisitorInterface::STATE_FOUND);
        $visitor2 = $this->createVisitor(0, true, 0, VisitorInterface::STATE_SEEKING);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);

        $visitorManager->visit($tokenPool, $context);
    }

    /**
     * @test
     * @expectedException \Zie\DeviceDetector\Exception\UnknownStateException
     */
    public function visitShouldThrowExceptionIfUnknownStateIsReturned()
    {
        $context = new Context();

        $token1 = $this->createToken('TokenMock1');

        $tokenPool = $this->createTokenPool();
        $tokenPool->addToken($token1);

        $visitor1 = $this->createVisitor(1, true, 1, 10);

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);

        $visitorManager->visit($tokenPool, $context);
    }

    /**
     * @param string $mockClassName
     * @return TokenInterface
     */
    private function createToken($mockClassName)
    {
        return $this->getMockBuilder('\Zie\DeviceDetector\Token\TokenInterface')
            ->setMockClassName($mockClassName)
            ->getMock();
    }

    /**
     * @return TokenPool
     */
    private function createTokenPool()
    {
        return new TokenPool();
    }

    /**
     * @param int $acceptCount
     * @param bool $acceptReturn
     * @param int $visitCount
     * @return VisitorInterface
     */
    private function createVisitor(
        $acceptCount = 1,
        $acceptReturn = true,
        $visitCount = 1,
        $visitReturn = VisitorInterface::STATE_SEEKING
    ) {
        $mock = $this->getMockBuilder('\Zie\DeviceDetector\Visitor\VisitorInterface')
            ->setMethods(array('accept', 'visit'))
            ->getMock();

        $mock->expects(new \PHPUnit_Framework_MockObject_Matcher_InvokedCount($acceptCount))
            ->method('accept')
            ->will($this->returnValue($acceptReturn));

        $mock->expects(new \PHPUnit_Framework_MockObject_Matcher_InvokedCount($visitCount))
            ->method('visit')
            ->will($this->returnValue($visitReturn));

        return $mock;
    }
}
