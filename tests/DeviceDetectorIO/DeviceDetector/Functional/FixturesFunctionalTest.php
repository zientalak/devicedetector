<?php

namespace DeviceDetectorIO\DeviceDetector\Tests\Functional;

use DeviceDetectorIO\DeviceDetector\Tests\TestCase\DeviceDetectorIOFunctionalTestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

/**
 * Class FixturesFunctionalTest
 * @package DeviceDetectorIO\DeviceDetector\Tests\Functional
 */
class FixturesFunctionalTest extends DeviceDetectorIOFunctionalTestCase
{
    /**
     * @test
     */
    public function recognizeUserAgentsCapabilities()
    {
        foreach ($this->loadFixtures() as $data) {
            $this->assertDeviceContainsCapabilities(
                $data['useragent'],
                $data['capabilities']
            );
        }

    }

    /**
     * @return array
     */
    private function loadFixtures()
    {
        $parser = new Parser();
        $finder = new Finder();
        $files = $finder
            ->depth('< 3')
            ->in(__DIR__ . '/../../../fixtures')
            ->files()
            ->name('*.yml');

        $fixtures = array();
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($files as $file) {
            $fixtures = array_merge($fixtures, $parser->parse($file->getContents()));
        }

        return $fixtures;
    }
}