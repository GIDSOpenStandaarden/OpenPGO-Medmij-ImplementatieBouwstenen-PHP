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

namespace MedMij\OpenPGO\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

abstract class MedMijClientTest extends TestCase
{
    /**
     * @test
     */
    abstract public function it_throws_when_content_type_is_not_xml();

    /**
     * @test
     */
    abstract protected function it_throws_when_xml_not_validated_against_xsd();

    /**
     * @param string $body
     *
     * @return Response
     */
    protected function createXmlResponseWithBody(string $body): Response
    {
        return new Response(200, ['Content-Type' => 'application/xml'], $body);
    }
}
