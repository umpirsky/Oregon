<?php

require __DIR__.'/../vendor/autoload.php';

$oregon = new Oregon\Oregon('Sylius');

echo $oregon->getDownloads().PHP_EOL;
