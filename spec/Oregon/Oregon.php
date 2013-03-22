<?php

namespace spec\Oregon;

use PHPSpec2\ObjectBehavior;

class Oregon extends ObjectBehavior
{
    /**
     * @param Github\Client           $github
     * @param Github\Api\Organization $organization
     * @param Github\Api\Repo         $repo
     */
    function let($github, $organization, $repo)
    {
        $github->api('organization')->willReturn($organization);
        $github->api('repo')->willReturn($repo);

        $this->beConstructedWith('Sylius', $github);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Oregon\Oregon');
    }

    function it_gets_contributors($github, $organization, $repo)
    {
        $organization->repositories('Sylius')->shouldBeCalled()->willReturn(array(
            array('name' => 'Sylius'),
            array('name' => 'SyliusPromotionsBundle'),
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
}
