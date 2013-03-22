<?php

namespace Oregon;

use Github\Client;
use YaLinqo\Enumerable;

class Oregon
{
    protected $organization;
    protected $github;

    public function __construct($organization, Client $github = null)
    {
        if (null === $github) {
            $github = new Client();
        }

        $this->github = $github;
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
}
