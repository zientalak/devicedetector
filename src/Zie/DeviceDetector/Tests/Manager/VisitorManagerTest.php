<?php

namespace Zie\DeviceDetector\Tests\Manager;

use Zie\DeviceDetector\Context\Context;
use Zie\DeviceDetector\Context\ContextInterface;
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
    const VISIT_CALLED = '%s_visit_called_%s';

    public function testPriority()
    {
        $visitor1 = $this->getVisitorMock();
        $visitor2 = $this->getVisitorMock();
        $visitor3 = $this->getVisitorMock();
        $visitor4 = $this->getVisitorMock();
        $visitor5 = $this->getVisitorMock();

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1, 0);
        $visitorManager->addVisitor($visitor2, 0);
        $visitorManager->addVisitor($visitor3, 10);
        $visitorManager->addVisitor($visitor4, 1);
        $visitorManager->addVisitor($visitor5, -100);

        $visitors = $visitorManager->getVisitors();
        $this->assertVisitorEquals($visitor3, $visitors[0]);
        $this->assertVisitorEquals($visitor4, $visitors[1]);
        $this->assertVisitorEquals($visitor1, $visitors[2]);
        $this->assertVisitorEquals($visitor2, $visitors[3]);
        $this->assertVisitorEquals($visitor5, $visitors[4]);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getVisitorMock()
    {
        return $this->getMock('\Zie\DeviceDetector\Visitor\VisitorInterface');
    }

    /**
     * @param $expected
     * @param $actual
     */
    private function assertVisitorEquals($expected, $actual)
    {
        $this->assertEquals(spl_object_hash($expected), spl_object_hash($actual));
    }

    public function testAddAndClearMethods()
    {
        $visitor1 = $this->getVisitorMock();
        $visitor2 = $this->getVisitorMock();
        $visitor3 = $this->getVisitorMock();
        $visitor4 = $this->getVisitorMock();
        $visitor5 = $this->getVisitorMock();

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);

        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);

        $this->assertCount(3, $visitorManager->getVisitors());

        $visitorManager->clear();
        $this->assertCount(0, $visitorManager->getVisitors());

        $visitorManager->addVisitor($visitor4);
        $visitorManager->addVisitor($visitor5);

        $this->assertCount(2, $visitorManager->getVisitors());
    }

    public function testHasAndRemoveMethods()
    {
        $visitor1 = $this->getVisitorMock();
        $visitor2 = $this->getVisitorMock();
        $visitor3 = $this->getVisitorMock();
        $visitor4 = $this->getVisitorMock();
        $visitor5 = $this->getVisitorMock();

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);

        $this->assertTrue($visitorManager->hasVisitor($visitor1));
        $this->assertTrue($visitorManager->hasVisitor($visitor2));
        $this->assertTrue($visitorManager->hasVisitor($visitor3));

        $visitorManager->removeVisitor($visitor1);
        $visitorManager->removeVisitor($visitor3);

        $this->assertFalse($visitorManager->hasVisitor($visitor1));
        $this->assertTrue($visitorManager->hasVisitor($visitor2));
        $this->assertFalse($visitorManager->hasVisitor($visitor3));
        $this->assertFalse($visitorManager->hasVisitor($visitor4));
        $this->assertFalse($visitorManager->hasVisitor($visitor5));

        $this->assertCount(1, $visitorManager->getVisitors());
    }

    public function testVisitMethod()
    {
        $context = new Context();

        $token1 = $this->getTokenMock('TokenMock1');
        $token2 = $this->getTokenMock('TokenMock2');

        $tokenPool = $this->getTokenPool();
        $tokenPool->addToken($token1);
        $tokenPool->addToken($token2);

        $visitor1 = $this->getVisitorMockForVisitMethod(
            $token1,
            $context,
            $token1,
            VisitorInterface::STATE_SEEKING
        );
        $visitor2 = $this->getVisitorMockForVisitMethod(
            $token2,
            $context,
            $token2,
            VisitorInterface::STATE_SEEKING
        );
        $visitor3 = $this->getVisitorMockForVisitMethod(
            $token1,
            $context,
            $token2,
            VisitorInterface::STATE_SEEKING
        );
        $visitor4 = $this->getVisitorMockForVisitMethod(
            $token2,
            $context,
            $token2,
            VisitorInterface::STATE_FOUND
        );
        $visitor5 = $this->getVisitorMockForVisitMethod(
            $token1,
            $context,
            $token1,
            VisitorInterface::STATE_SEEKING
        );
        $visitor6 = $this->getVisitorMockForVisitMethod(
            $token2,
            $context,
            $token2,
            VisitorInterface::STATE_SEEKING
        );

        $visitorManager = new VisitorManager();
        $visitorManager->addVisitor($visitor1);
        $visitorManager->addVisitor($visitor2);
        $visitorManager->addVisitor($visitor3);
        $visitorManager->addVisitor($visitor4);
        $visitorManager->addVisitor($visitor5);
        $visitorManager->addVisitor($visitor6);

        $visitorManager->visit($tokenPool, $context);

        $this->assertCapability($context, $visitor1, $token1, true);
        $this->assertCapability($context, $visitor1, $token2, false);
        $this->assertCapability($context, $visitor2, $token2, true);
        $this->assertCapability($context, $visitor2, $token1, false);
        $this->assertCapability($context, $visitor3, $token1, false);
        $this->assertCapability($context, $visitor3, $token2, true);
        $this->assertCapability($context, $visitor4, $token1, false);
        $this->assertCapability($context, $visitor4, $token2, true);
        $this->assertCapability($context, $visitor5, $token1, false);
        $this->assertCapability($context, $visitor5, $token2, false);
        $this->assertCapability($context, $visitor5, $token1, false);
        $this->assertCapability($context, $visitor5, $token2, false);
    }

    /**
     * @param string $mockClassName
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getTokenMock($mockClassName)
    {
        return $this->getMockBuilder('\Zie\DeviceDetector\Token\TokenInterface')
            ->setMockClassName($mockClassName)
            ->getMock();
    }

    /**
     * @return TokenPool
     */
    private function getTokenPool()
    {
        return new TokenPool();
    }

    /**
     * @param TokenInterface $token
     * @param ContextInterface $context
     * @param TokenInterface $accept
     * @param int $visitReturn
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getVisitorMockForVisitMethod(
        TokenInterface $token,
        ContextInterface $context,
        TokenInterface $accept,
        $visitReturn = VisitorInterface::STATE_SEEKING
    ) {
        $mock = $this->getVisitorMock();
        $mock->expects($this->any())
            ->method('accept')
            ->will(
                $this->returnCallback(
                    function (TokenInterface $token, ContextInterface $context) use ($accept) {
                        $instanceof = get_class($accept);
                        return $token instanceof $instanceof;
                    }
                )
            );
        $mock->expects($this->any())
            ->method('visit')
            ->will(
                $this->returnCallback(
                    function (TokenInterface $token, ContextInterface $context) use ($mock, $visitReturn) {

                        $context->setCapability(
                            sprintf(
                                self::VISIT_CALLED,
                                spl_object_hash($mock),
                                spl_object_hash($token)
                            ),
                            true
                        );

                        return $visitReturn;
                    }
                )
            );

        return $mock;
    }

    /**
     * @param ContextInterface $context
     * @param VisitorInterface $visitor
     * @param TokenInterface $token
     * @param boolean $assert
     */
    private function assertCapability(
        ContextInterface $context,
        VisitorInterface $visitor,
        TokenInterface $token,
        $assert
    ) {
        $this->assertEquals(
            $assert,
            $context->hasCapability(
                sprintf(
                    self::VISIT_CALLED,
                    spl_object_hash($visitor),
                    spl_object_hash($token)
                )
            )
        );
    }

} 