<?php

/**
 * Copyright (C) 2018 Mainly Code
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>
 */

declare(strict_types=1);

namespace MedMij\OpenPGO\OCL;

use PHPUnit\Framework\TestCase;

class OAuthClientServiceTest extends TestCase
{
    const WHITELIST_ENDPOINT = '/oauth';

    /**
     * @var OAuthClientListClient
     */
    private $client;

    /**
     * @var OAuthClientService
     */
    private $service;

    protected function setUp()
    {
        $this->client = $this->prophesize(OAuthClientListClient::class);
        $this->service = new OAuthClientService($this->client->reveal());
    }

    /**
     * @test
     */
    public function it_finds_an_oauth_client_by_hostname()
    {
        $expectedOAuthClient = new OAuthClient('medmij.deenigeechtepgo.nl', 'De Enige Echte PGO');

        $oAuthClientList = new OAuthClientList(new \DateTimeImmutable(), 1337, [$expectedOAuthClient]);

        $this->client
            ->getOAuthClientList()
            ->shouldBeCalled()
            ->willReturn($oAuthClientList);

        $this->assertEquals($expectedOAuthClient, $this->service->getOAuthClientByHostname('medmij.deenigeechtepgo.nl'));
    }

    /**
     * @test
     */
    public function it_throws_when_oauth_client_cannot_be_found_by_hostname()
    {
        $oAuthClientList = new OAuthClientList(new \DateTimeImmutable(), 1337, []);

        $this->client
            ->getOAuthClientList()
            ->shouldBeCalled()
            ->willReturn($oAuthClientList);

        $this->expectException(OAuthClientNotFoundException::class);

        $this->service->getOAuthClientByHostname('medmij.deenigeechtepgo.nl');
    }
}
