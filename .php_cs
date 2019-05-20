<?php
$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('tests')
    ->notPath('_assets')
    ->filter(function (SplFileInfo $file) {
        if (strstr($file->getPath(), 'compatibility')) {
            return false;
        }
    });
$config = PhpCsFixer\Config::create();
$config->setRules(['@PSR2' => true]);
$config->setFinder($finder);
return $config;
