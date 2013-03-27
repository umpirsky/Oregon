<?php

require __DIR__.'/../vendor/autoload.php';

$downloads = (new Oregon\Oregon('Sylius'))->getDownloads();

printf('daily: %d%s', $downloads->getDaily(), PHP_EOL);
printf('monthly: %d%s', $downloads->getMonthly(), PHP_EOL);
printf('total: %d%s', $downloads->getTotal(), PHP_EOL);
