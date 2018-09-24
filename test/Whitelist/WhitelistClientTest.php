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

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MedMij\OpenPGO\Client\InvalidContentTypeException;
use MedMij\OpenPGO\Client\InvalidXmlException;
use MedMij\OpenPGO\Client\MedMijClientTest;

class WhitelistClientTest extends MedMijClientTest
{
    /**
     * @param Response $response
     *
     * @return WhitelistClient
     */
    protected function createMockClientWithResponse(Response $response): WhitelistClient
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        return new WhitelistClient($httpClient, '/endpoint');
    }

    /**
     * @test
     */
    public function it_throws_when_content_type_is_not_xml()
    {
        $this->expectException(InvalidContentTypeException::class);

        $client = $this->createMockClientWithResponse(new Response(200, ['Content-Type' => 'text/plain']));
        $client->getWhitelist();
    }

    /**
     * @test
     */
    public function it_throws_when_xml_not_validated_against_xsd()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Whitelist xmlns="xmlns://afsprakenstelsel.medmij.nl/whitelist/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/whitelist/release2/MedMij_Whitelist.xsd">
    <Tijdstempel>invalid timestamp</Tijdstempel>
    <Volgnummer>invalid index</Volgnummer>
    <MedMijNodes>
        <MedMijNode>nonunique.node</MedMijNode>
        <MedMijNode>nonunique.node</MedMijNode>
    </MedMijNodes>
</Whitelist>');
        $client = $this->createMockClientWithResponse($response);

        $this->expectException(InvalidXmlException::class);

        $client->getWhitelist();
    }

    /**
     * @test
     */
    public function it_gets_a_whitelist()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Whitelist xmlns="xmlns://afsprakenstelsel.medmij.nl/whitelist/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/whitelist/release2/MedMij_Whitelist.xsd">
    <Tijdstempel>2018-04-16T10:43:41+01:00</Tijdstempel>
    <Volgnummer>28654</Volgnummer>
    <MedMijNodes>
        <MedMijNode>specimen-stelselnode.medmij.nl</MedMijNode>
        <MedMijNode>medmij.deenigeechtepgo.nl</MedMijNode>
        <MedMijNode>pgocluster68.personalhealthprovider.net</MedMijNode>
        <MedMijNode>78834.umcharderwijk.nl</MedMijNode>
        <MedMijNode>medmij.za982.xisbridge.net</MedMijNode>
        <MedMijNode>medmij.za983.xisbridge.net</MedMijNode>
        <MedMijNode>medmij.xisbridge.net</MedMijNode>
        <MedMijNode>rcf-rso.nl</MedMijNode>
    </MedMijNodes>
</Whitelist>');
        $client = $this->createMockClientWithResponse($response);

        $this->assertInstanceOf(Whitelist::class, $client->getWhitelist());
    }
}
