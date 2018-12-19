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
        $whitelist = new Whitelist(
            new \DateTimeImmutable(),
            1337,
            [
                new MedMijNode('specimen-stelselnode.medmij.nl'),
            ]
        );

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
