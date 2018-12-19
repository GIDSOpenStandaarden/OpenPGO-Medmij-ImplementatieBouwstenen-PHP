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

namespace MedMij\OpenPGO\GNL;

use PHPUnit\Framework\TestCase;

class GegevensdienstnamenlijstServiceTest extends TestCase
{
    const WHITELIST_ENDPOINT = '/gegevensdienstnamenlijst';

    /**
     * @var GegevensdienstnamenlijstClient
     */
    private $client;

    /**
     * @var GegevensdienstnamenlijstService
     */
    private $service;

    protected function setUp()
    {
        $this->client = $this->prophesize(GegevensdienstnamenlijstClient::class);
        $this->service = new GegevensdienstnamenlijstService($this->client->reveal());
    }

    /**
     * @test
     */
    public function it_finds_a_gegevensdienst_by_id()
    {
        $expectedGegevensdienst = new Gegevensdienst(42, 'Basisgegevens Zorg');

        $gegevensdienstnamenlijst = new Gegevensdienstnamenlijst(
            new \DateTimeImmutable(),
            1337,
            [$expectedGegevensdienst]
        );

        $this->client
            ->getGegevensdienstnamenlijst()
            ->shouldBeCalled()
            ->willReturn($gegevensdienstnamenlijst);

        $this->assertEquals($expectedGegevensdienst, $this->service->getGegevensdienstById(42));
    }

    /**
     * @test
     */
    public function it_throws_when_oauth_client_cannot_be_found_by_hostname()
    {
        $gegevensdienstnamenlijst = new Gegevensdienstnamenlijst(new \DateTimeImmutable(), 1337, []);

        $this->client
            ->getGegevensdienstnamenlijst()
            ->shouldBeCalled()
            ->willReturn($gegevensdienstnamenlijst);

        $this->expectException(GegevensdienstNotFoundException::class);

        $this->service->getGegevensdienstById(42);
    }
}
