<?php

require __DIR__ . '/../../vendor/autoload.php';

$userAgents = array(
    'Mozilla/5.0 (iPad2,2; iPad; U; CPU OS 7_0 like Mac OS X; nl_NL) com.google.GooglePlus/23341 (KHTML, like Gecko) Mobile/K94AP (gzip)',
    'Mozilla/5.0 (Linux; Android 4.4; Nexus 7 Build/KOT24) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.105 Safari/537.36',
    'Mozilla/5.0 (X11; U; Linux Gentoo i686; pl; rv:1.8.0.8) Gecko/20061219 Firefox/1.5.0.8',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.38 Safari/537.36',
    'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch IEMobile/11.0; HTC; Windows Phone 8S by HTC) like Gecko',
    'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; GTB6; Ant.com Toolbar 1.6; MSIECrawler)',
    'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
    'php-openid/2.1.1 (php/5.2.5.fb4) curl/7.15.5',
    'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) 320x240; VZW; Motorola-Q9c; Windows Mobile 6.1 Standard',
    'curl 7.16.1 (i386-portbld-freebsd6.2) libcurl/7.16.1 OpenSSL/0.9.7m zlib/1.2.3'
);

shuffle($userAgents);

$stopwatch = new \Symfony\Component\Stopwatch\Stopwatch();
$stopwatch->start('benchmark');

$factory = new \DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory();

foreach ($userAgents as $userAgent) {
    $factory->getDevice($userAgent);
}

$event = $stopwatch->stop('benchmark');

printf("Benchmark results for 10 useragents:\n");
printf("Duration %s milliseconds.\n", $event->getDuration());
printf("Memory %s bytes.\n", $event->getMemory());