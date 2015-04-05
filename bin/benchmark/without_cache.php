<?php

require __DIR__ . '/../../vendor/autoload.php';

$userAgents = array(
    'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120515 Firefox/12.0 AvantBrowser/Tri-Core'
);

shuffle($userAgents);

$stopwatch = new \Symfony\Component\Stopwatch\Stopwatch();
$stopwatch->start('benchmark');

$factory = new \DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory();

foreach ($userAgents as $userAgent) {
    var_dump($factory->getDevice($userAgent));
}

$event = $stopwatch->stop('benchmark');

printf("Benchmark results for 1 useragents:\n");
printf("Duration %s milliseconds.\n", $event->getDuration());
printf("Memory %s bytes.\n", $event->getMemory());