<?php

namespace spec\Oregon;

use PHPSpec2\ObjectBehavior;

class Oregon extends ObjectBehavior
{
    /**
     * @param Github\Client           $github
     * @param Packagist\Api\Client    $packagist
     * @param Github\Api\Organization $organization
     * @param Github\Api\Repo         $repo
     */
    function let($github, $packagist, $organization, $repo)
    {
        $github->api('organization')->willReturn($organization);
        $github->api('repo')->willReturn($repo);

        $this->beConstructedWith('Sylius', $github, $packagist);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Oregon\Oregon');
    }

    function it_gets_contributors($github, $organization, $repo)
    {
        $organization->repositories('Sylius')->shouldBeCalled()->willReturn(array(
            array('name' => 'Sylius', 'fork' => false),
            array('name' => 'SyliusPromotionsBundle', 'fork' => false),
        ));
        $repo->contributors('Sylius', 'Sylius')->shouldBeCalled()->willReturn(array(
            array('id' => 1, 'contributions' => 5),
            array('id' => 2, 'contributions' => 10),
        ));
        $repo->contributors('Sylius', 'SyliusPromotionsBundle')->shouldBeCalled()->willReturn(array(
            array('id' => 1, 'contributions' => 3),
            array('id' => 3, 'contributions' => 3),
        ));

        $this->getContributors()->shouldReturn(array(
            array('id' => 2, 'contributions' => 10),
            array('id' => 1, 'contributions' => 8),
            array('id' => 3, 'contributions' => 3),
        ));
    }

    function it_skips_forked_repositories($github, $organization, $repo)
    {
        $organization->repositories('Sylius')->shouldBeCalled()->willReturn(array(
            array('name' => 'Sylius', 'fork' => false),
            array('name' => 'SyliusPromotionsBundle', 'fork' => true),
        ));
        $repo->contributors('Sylius', 'Sylius')->shouldBeCalled()->willReturn(array(
            array('id' => 1, 'contributions' => 5),
            array('id' => 2, 'contributions' => 10),
        ));

        $repo->contributors('Sylius', 'SyliusPromotionsBundle')->shouldNotBeCalled();

        $this->getContributors()->shouldReturn(array(
            array('id' => 2, 'contributions' => 10),
            array('id' => 1, 'contributions' => 5),
        ));
    }

    /**
     * @param Packagist\Api\Result\Package           $package
     * @param Packagist\Api\Result\Package\Downloads $downloads
     */
    function it_gets_downloads($packagist, $package, $downloads)
    {
        $packagist->all(array('vendor' => 'Sylius'))->shouldBeCalled()->willReturn(array('Sylius/Sylius'));
        $packagist->get('Sylius/Sylius')->shouldBeCalled()->willReturn($package);
        $package->getDownloads()->shouldBeCalled()->willReturn($downloads);
        $downloads->getTotal()->shouldBeCalled()->willReturn(999999999);
        $downloads->getMonthly()->shouldBeCalled()->willReturn(99999);
        $downloads->getDaily()->shouldBeCalled()->willReturn(999);

        $this->getDownloads()->shouldHaveType('Packagist\Api\Result\Package\Downloads');
    }
}
