<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\Whitelist;

use PHPUnit\Framework\TestCase;

class WhitelistServiceTest extends TestCase
{
    const WHITELIST_ENDPOINT = '/whitelist';

    /**
     * @var WhitelistClient
     */
    private $client;

    /**
     * @var WhitelistService
     */
    private $service;

    protected function setUp()
    {
        $this->client = $this->prophesize(WhitelistClient::class);
        $this->service = new WhitelistService($this->client->reveal());
    }

    /**
     * @test
     */
    public function it_returns_true_when_node_is_whitelisted()
    {
        $whitelist = new Whitelist(new \DateTimeImmutable(), 1337, ['specimen-stelselnode.medmij.nl']);

        $this->client
            ->getWhitelist()
            ->shouldBeCalled()
            ->willReturn($whitelist);

        $this->assertTrue($this->service->isMedMijNodeWhitelisted('specimen-stelselnode.medmij.nl'));
    }

    /**
     * @test
     */
    public function it_returns_false_when_node_is_not_whitelisted()
    {
        $whitelist = new Whitelist(new \DateTimeImmutable(), 1337, []);

        $this->client
            ->getWhitelist()
            ->shouldBeCalled()
            ->willReturn($whitelist);

        $this->assertFalse($this->service->isMedMijNodeWhitelisted('specimen-stelselnode.medmij.nl'));
    }
}
