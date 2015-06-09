<?php

namespace DeviceDetectorIO\DeviceDetector\Rule\Configuration\Loader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

/**
 * Class YmlLoader
 * @package DeviceDetectorIO\DeviceDetector\Rule\Loader
 */
class YmlLoader implements LoaderInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var int
     */
    private $maxDepth = 3;

    /**
     * @param Parser $parser
     * @param Finder $finder
     * @param $directory
     */
    public function __construct(Parser $parser, Finder $finder, $directory)
    {
        $this->parser = $parser;
        $this->finder = $finder;
        $this->setDirectory($directory);
    }

    /**
     * @param string $directory
     * @return self
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * @param int $maxDepth
     * @return self
     */
    public function setMaxDepth($maxDepth)
    {
        $this->maxDepth = (int)$maxDepth;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $rules = array();
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($this->loadFiles() as $file) {
            $rules = array_merge(
                $rules,
                $this->parser->parse($file->getContents())
            );
        }

        return $rules;
    }

    /**
     * @return Finder
     */
    private function loadFiles()
    {
        return $this->finder
            ->depth(sprintf('< %s', $this->maxDepth))
            ->in($this->directory)
            ->files()
            ->name('*.yml');
    }
}
