<?php

namespace spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Parser;

/**
 * Class YmlLoaderSpec
 * @package spec\DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader
 */
class YmlLoaderSpec extends ObjectBehavior
{
    function let(Parser $parser, Finder $finder)
    {
        $this->beConstructedWith($parser, $finder, 'directory');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader\YmlLoader');
    }

    function it_implements_loader_interface()
    {
        $this->shouldImplement('DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader\LoaderInterface');
    }

    function it_load_configuration(Parser $parser, Finder $finder, SplFileInfo $file)
    {
        $directory = 'directory';
        $maxDepth = 3;

        $this->beConstructedWith($parser, $finder, $directory);
        $this->setMaxDepth($maxDepth)->shouldReturn($this);

        $finder->depth(Argument::exact(sprintf('< %s', $maxDepth)))
            ->shouldBeCalled()
            ->willReturn($finder);

        $finder->in(Argument::exact($directory))
            ->shouldBeCalled()
            ->willReturn($finder);

        $finder->files()
            ->shouldBeCalled()
            ->willReturn($finder);

        $finder->name(Argument::exact('*.yml'))
            ->shouldBeCalled()
            ->willReturn(
                array(
                    $file
                )
            );

        $ymlContent = <<<EOD
-
  conditions:
     -
        type: text
        value: chrome
        strategy: sequence
EOD;

        $file->getContents()
            ->shouldBeCalled()
            ->willReturn($ymlContent);

        $parser->parse(Argument::exact($ymlContent))
            ->shouldBeCalled()
            ->willReturn(array(true));

        $this->load()->shouldReturn(array(true));
    }
}
