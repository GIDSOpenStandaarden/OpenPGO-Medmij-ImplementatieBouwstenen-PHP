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

class SysteemrolTest extends TestCase
{
    /**
     * @test
     */
    public function it_exposes_a_resource_endpoint()
    {
        $expectedResourceEndpoint = 'https://medmij.za982.xisbridge.net/fhir';

        $systeemrol = new Systeemrol('1337', new ResourceEndpoint($expectedResourceEndpoint));

        $this->assertEquals($expectedResourceEndpoint, (string) $systeemrol->getResourceEndpoint());
    }
}
