<?php

namespace Oregon;

use Github\Client as Github;
use Packagist\Api\Client as Packagist;
use Packagist\Api\Result\Package\Downloads;
use YaLinqo\Enumerable;

class Oregon
{
    protected $organization;
    protected $github;
    protected $packagist;

    public function __construct($organization, Github $github = null, Packagist $packagist = null)
    {
        if (null === $github) {
            $github = new Github();
        }
        if (null === $packagist) {
            $packagist = new Packagist();
        }

        $this->github = $github;
        $this->packagist = $packagist;
        $this->organization = $organization;
    }

    public function getContributors()
    {
        $contributors = array();

        foreach ($this->github->api('organization')->repositories($this->organization) as $repository) {
            $contributors = array_merge(
                $this->github->api('repo')->contributors($this->organization, $repository['name']),
                $contributors
            );
        }

        return Enumerable::from($contributors)
            ->groupBy(
                '$v["id"]',
                null,
                function($contributors) {
                    $contributor = $contributors[0];
                    $contributor['contributions'] = Enumerable::from($contributors)->sum('$v["contributions"]');

                    return $contributor;
                }
            )
            ->orderByDescending('$v["contributions"]')
            ->toValues()
            ->toArray()
        ;
    }

    public function getDownloads()
    {
        $downloads = new Downloads();
        $packagist = $this->packagist;
        $packages = $this->packagist->all(array('vendor' => $this->organization));

        $downloads->setTotal(Enumerable::from($packages)->sum(function($package) use ($packagist) {
            return $packagist->get($package)->getDownloads()->getTotal();
        }));
        $downloads->setMonthly(Enumerable::from($packages)->sum(function($package) use ($packagist) {
            return $packagist->get($package)->getDownloads()->getMonthly();
        }));
        $downloads->setDaily(Enumerable::from($packages)->sum(function($package) use ($packagist) {
            return $packagist->get($package)->getDownloads()->getDaily();
        }));

        return $downloads;
    }
}
