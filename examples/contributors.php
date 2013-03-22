<?php

require __DIR__.'/../vendor/autoload.php';

$oregon = new Oregon\Oregon(
    'Sylius',
    new Github\Client(
        new Github\HttpClient\CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache'))
    )
);

foreach ($oregon->getContributors() as $position => $contributor) {
    printf('%d. %s (%d)%s', $position + 1, $contributor['login'], $contributor['contributions'], PHP_EOL);
}