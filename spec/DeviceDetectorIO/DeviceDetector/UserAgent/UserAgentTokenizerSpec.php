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
        $nodes->push(new Node('mozilla', NodeInterface::TYPE_TEXT, 0));
        $nodes->push(new Node('/', NodeInterface::TYPE_TEXT, 1));
        $nodes->push(new Node('5.0', NodeInterface::TYPE_TEXT, 2));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 3));
        $nodes->push(new Node('(', NodeInterface::TYPE_TEXT, 4));
        $nodes->push(new Node('compatible', NodeInterface::TYPE_TEXT, 5));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 6));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 7));
        $nodes->push(new Node('msie', NodeInterface::TYPE_TEXT, 8));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 9));
        $nodes->push(new Node('9.0', NodeInterface::TYPE_TEXT, 10));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 11));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 12));
        $nodes->push(new Node('windows', NodeInterface::TYPE_TEXT, 13));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 14));
        $nodes->push(new Node('nt', NodeInterface::TYPE_TEXT, 15));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 16));
        $nodes->push(new Node('6.1', NodeInterface::TYPE_TEXT, 17));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 18));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 19));
        $nodes->push(new Node('trident', NodeInterface::TYPE_TEXT, 20));
        $nodes->push(new Node('/', NodeInterface::TYPE_TEXT, 21));
        $nodes->push(new Node('5.0', NodeInterface::TYPE_TEXT, 22));
        $nodes->push(new Node(')', NodeInterface::TYPE_TEXT, 23));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 24));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 25));
        $nodes->push(new Node('360spider', NodeInterface::TYPE_TEXT, 26));
        $nodes->push(new Node('(', NodeInterface::TYPE_TEXT, 27));
        $nodes->push(new Node('compatible', NodeInterface::TYPE_TEXT, 28));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 29));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 30));
        $nodes->push(new Node('haosouspider', NodeInterface::TYPE_TEXT, 31));
        $nodes->push(new Node(';', NodeInterface::TYPE_TEXT, 32));
        $nodes->push(new Node('', NodeInterface::TYPE_SPACE, 33));
        $nodes->push(new Node('http://www.haosou.com/help/help_3_2.html', NodeInterface::TYPE_TEXT, 34));
        $nodes->push(new Node(')', NodeInterface::TYPE_TEXT, 35));

        $tokenized->shouldReturnAnInstanceOf('\Iterator');
        /** @var NodeInterface $node */
        foreach($nodes as $node) {
            $tokenized[$node->getPosition()]->getValue()->shouldReturn($node->getValue());
            $tokenized[$node->getPosition()]->getType()->shouldReturn($node->getType());
        }
    }
}
