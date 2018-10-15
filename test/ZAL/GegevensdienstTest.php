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

class GegevensdienstTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_a_systeemrol_by_code()
    {
        $expectedSysteemrol = new Systeemrol('1337', new ResourceEndpoint('https://medmij.za982.xisbridge.net/fhir'));

        $gegevensdienst = new Gegevensdienst(
            '1337',
            new AuthorizationEndpoint('https://medmij.za982.xisbridge.net/oauth/authorize'),
            new TokenEndpoint('https://medmij.xisbridge.net/oauth/token'),
            [$expectedSysteemrol]
        );

        $this->assertEquals($expectedSysteemrol, $gegevensdienst->getSysteemrol('1337'));
    }

    /**
     * @test
     */
    public function it_throws_when_systeemrol_not_found()
    {
        $gegevensdienst = new Gegevensdienst(
            '1337',
            new AuthorizationEndpoint('https://medmij.za982.xisbridge.net/oauth/authorize'),
            new TokenEndpoint('https://medmij.xisbridge.net/oauth/token'),
            []
        );

        $this->expectException(SysteemrolNotFoundException::class);

        $gegevensdienst->getSysteemrol('1337');
    }
}
