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

class ZorgaanbiederTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_a_gegevensdienst_by_id()
    {
        $expectedGegevensdienst = new Gegevensdienst(
            '1337',
            new AuthorizationEndpoint('https://medmij.za982.xisbridge.net/oauth/authorize'),
            new TokenEndpoint('https://medmij.xisbridge.net/oauth/token'),
            []
        );

        $zorgaanbieder = new Zorgaanbieder('umcharderwijk@medmij', [$expectedGegevensdienst]);

        $this->assertEquals($expectedGegevensdienst, $zorgaanbieder->getGegevensdienst('1337'));
    }

    /**
     * @test
     */
    public function it_throws_when_gegevensdienst_not_found()
    {
        $zorgaanbieder = new Zorgaanbieder('umcharderwijk@medmij', []);

        $this->expectException(GegevensdienstNotFoundException::class);

        $zorgaanbieder->getGegevensdienst('1337');
    }
}
