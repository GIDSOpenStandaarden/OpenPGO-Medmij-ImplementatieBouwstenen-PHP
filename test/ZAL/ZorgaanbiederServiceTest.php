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

namespace MedMij\OpenPGO\ZAL;

use PHPUnit\Framework\TestCase;

class ZorgaanbiederServiceTest extends TestCase
{
    const WHITELIST_ENDPOINT = '/zal';

    /**
     * @var ZALClient
     */
    private $client;

    /**
     * @var ZorgaanbiederService
     */
    private $service;

    protected function setUp()
    {
        $this->client = $this->prophesize(ZALClient::class);
        $this->service = new ZorgaanbiederService($this->client->reveal());
    }

    /**
     * @test
     */
    public function it_finds_a_zorgaanbieder_by_name()
    {
        $expectedZorgaanbieder = new Zorgaanbieder('umcharderwijk@medmij', []);

        $zorgaanbiederlijst = new Zorgaanbiederslijst(new \DateTimeImmutable(), 1337, [$expectedZorgaanbieder]);

        $this->client
            ->getZAL()
            ->shouldBeCalled()
            ->willReturn($zorgaanbiederlijst);

        $this->assertEquals($expectedZorgaanbieder, $this->service->getZorgaanbiederByName('umcharderwijk@medmij'));
    }

    /**
     * @test
     */
    public function it_throws_when_zorgaanbieder_cannot_be_found_by_name()
    {
        $zorgaanbiederlijst = new Zorgaanbiederslijst(new \DateTimeImmutable(), 1337, []);

        $this->client
            ->getZAL()
            ->shouldBeCalled()
            ->willReturn($zorgaanbiederlijst);

        $this->expectException(ZorgaanbiederNotFoundException::class);

        $this->service->getZorgaanbiederByName('umcharderwijk@medmij');
    }
}
