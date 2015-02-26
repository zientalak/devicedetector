<?php

require __DIR__.'/../vendor/autoload.php';

$finder = new \Symfony\Component\Finder\Finder();

$files = $finder->in(__DIR__ . '/../resources/rules/yml/basic')->files()->name('*.yml');
$parser = new \Symfony\Component\Yaml\Parser();

$rules = array();
/** @var \Symfony\Component\Finder\SplFileInfo $file */
foreach ($files as $file) {
    $rules = array_merge($rules, $parser->parse($file->getContents()));
}

$destination = new \SplFileObject(__DIR__.'/../resources/rules/json/basic.json', 'w');
$destination->fwrite(json_encode($rules));
