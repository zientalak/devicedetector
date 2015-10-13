<?php

require __DIR__ . '/../../vendor/autoload.php';

$userAgents = array(
    'Mozilla/5.0 (Linux; U; Android 4.3; zh-cn; MI 3W Build/JLS36C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30 XiaoMi/MiuiBrowser/1.0'
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