<?php

namespace spec\DeviceDetectorIO\DeviceDetector\UserAgent;

use DeviceDetectorIO\DeviceDetector\UserAgent\Node;
use DeviceDetectorIO\DeviceDetector\UserAgent\NodeInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAgentTokenizerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizer');
    }

    function it_implements_tokenizer_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\UserAgent\UserAgentTokenizerInterface');
    }

    function it_tokenize_useragent()
    {
        $tokenized = $this->tokenize('Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider(compatible; HaosouSpider; http://www.haosou.com/help/help_3_2.html)');

        $nodes = new \SplDoublyLinkedList();
        $nodes->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO);
        $nodes->push(new Node('mozilla', 0, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('/', 1, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('5.0', 2, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 3, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('(', 4, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('compatible', 5, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 6, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 7, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('msie', 8, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 9, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('9.0', 10, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 11, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 12, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('windows', 13, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 14, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('nt', 15, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 16, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('6.1', 17, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 18, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 19, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('trident', 20, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('/', 21, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('5.0', 22, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(')', 23, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 24, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 25, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('360spider', 26, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('(', 27, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('compatible', 28, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 29, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 30, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('haosouspider', 31, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(';', 32, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node('', 33, NodeInterface::TYPE_SPACE));
        $nodes->push(new Node('http://www.haosou.com/help/help_3_2.html', 34, NodeInterface::TYPE_TEXT));
        $nodes->push(new Node(')', 35, NodeInterface::TYPE_TEXT));

        $tokenized->shouldReturnAnInstanceOf('\Iterator');
        /** @var NodeInterface $node */
        foreach($nodes as $node) {
            $tokenized[$node->getPosition()]->getValue()->shouldReturn($node->getValue());
            $tokenized[$node->getPosition()]->getType()->shouldReturn($node->getType());
        }
    }
}
