<?php

require __DIR__ . '/../../vendor/autoload.php';

$userAgents = array(
    'Mozilla/5.0 (Linux; Android 4.3; XT939G Build/14.10.0Q3.X-84) AppleWebKit/537.36 (KHTML, like Gecko)'
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