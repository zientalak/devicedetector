Device Detector for PHP
==============

[![Build Status](https://travis-ci.org/zientalak/devicedetector.svg?branch=master)](https://travis-ci.org/zientalak/devicedetector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zientalak/devicedetector/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zientalak/devicedetector/?branch=master)
[![Code Climate](https://codeclimate.com/github/zientalak/devicedetector/badges/gpa.svg)](https://codeclimate.com/github/zientalak/devicedetector)
[![Code Coverage](https://scrutinizer-ci.com/g/zientalak/devicedetector/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zientalak/devicedetector/?branch=master)

Device Detector is PHP library for detecting devices.
The main goal is analyse input data (like User Agent) and recognize device capabilities.

## Usage

Using DeviceDetector.IO library is very easy:

```php
require __DIR__ . '/../../vendor/autoload.php';

$factory = new \DeviceDetectorIO\DeviceDetector\Factory\DeviceUserAgentFactory();
/** \DeviceDetectorIO\DeviceDetector\DeviceInterface $device */
$device = $factory->getDevice('Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_5_6; it-it) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16');

$device->isMobile(); // true
$device->isDesktop(); // false
$device->isBot(); // false
$device->getBrowserName() // Safari
$device->getCapability('browser_name') // Safari
$device->getCapabilities() // capabilities array
```

### Running tests

You can run unit test by executing following command:
```
cp phpunit.xml.dist phpunit.xml
php bin/rules_warmup; bin/phpunit -c phpunit.xml
```

You can run functional by executing following command:
```
cp phpspec.yml.dist phpspec.yml
php bin/phpspec run -c phpspec.yml
```