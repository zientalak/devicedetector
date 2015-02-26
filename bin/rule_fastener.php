<?php

require __DIR__.'/../vendor/autoload.php';

$finder = new \Symfony\Component\Finder\Finder();

$files = $finder->in(__DIR__ . '/../Resources/rules')->files()->name('*.yml');
$parser = new \Symfony\Component\Yaml\Parser();
/** @var \Symfony\Component\Finder\SplFileInfo $file */

$rules = array();
foreach ($files as $file) {
    $rules = array_merge($rules, $parser->parse($file->getContents()));
}

$destination = new \SplFileObject(__DIR__.'/../Resources/cache/rules.json', 'w');
$destination->fwrite(json_encode($rules));
