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

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MedMij\OpenPGO\Client\InvalidContentTypeException;
use MedMij\OpenPGO\Client\InvalidXmlException;
use MedMij\OpenPGO\Client\MedMijClientTest;

class GegevensdienstnamenlijstClientTest extends MedMijClientTest
{
    /**
     * @param Response $response
     *
     * @return GegevensdienstnamenlijstClient
     */
    protected function createMockClientWithResponse(Response $response): GegevensdienstnamenlijstClient
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        return new GegevensdienstnamenlijstClient($httpClient, '/endpoint');
    }

    /**
     * @test
     */
    public function it_throws_when_content_type_is_not_xml()
    {
        $this->expectException(InvalidContentTypeException::class);

        $client = $this->createMockClientWithResponse(new Response(200, ['Content-Type' => 'text/plain']));
        $client->getGegevensdienstnamenlijst();
    }

    /**
     * @test
     */
    public function it_throws_when_xml_not_validated_against_xsd()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Gegevensdienstnamenlijst xmlns="xmlns://afsprakenstelsel.medmij.nl/gegevensdienstnamenlijst/release1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/gegevensdienstnamenlijst/release1/ MedMij_Gegevensdienstnamenlijst.xsd">
    <Tijdstempel>2018-07-19T10:43:41+01:00</Tijdstempel>
    <Volgnummer>28800</Volgnummer>
    <Gegevensdiensten>
        <Gegevensdienst>
            <GegevensdienstId>1</GegevensdienstId>
            <Weergavenaam>Basisgegevens Zorg</Weergavenaam>
        </Gegevensdienst>
        <Gegevensdienst>
            <GegevensdienstId>1</GegevensdienstId>
            <Weergavenaam>Basisgegevens Zorg</Weergavenaam>
        </Gegevensdienst>
    </Gegevensdiensten>
</Gegevensdienstnamenlijst>');
        $client = $this->createMockClientWithResponse($response);

        $this->expectException(InvalidXmlException::class);

        $client->getGegevensdienstnamenlijst();
    }

    /**
     * @test
     */
    public function it_gets_a_gegevensdienstnamenlijst()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Gegevensdienstnamenlijst xmlns="xmlns://afsprakenstelsel.medmij.nl/gegevensdienstnamenlijst/release1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/gegevensdienstnamenlijst/release1/ MedMij_Gegevensdienstnamenlijst.xsd">
    <Tijdstempel>2018-07-19T10:43:41+01:00</Tijdstempel>
    <Volgnummer>28800</Volgnummer>
    <Gegevensdiensten>
        <Gegevensdienst>
            <GegevensdienstId>1</GegevensdienstId>
            <Weergavenaam>Basisgegevens Zorg</Weergavenaam>
        </Gegevensdienst>
        <Gegevensdienst>
            <GegevensdienstId>2</GegevensdienstId>
            <Weergavenaam>Medicatieoverzichten</Weergavenaam>
        </Gegevensdienst>
    </Gegevensdiensten>
</Gegevensdienstnamenlijst>');
        $client = $this->createMockClientWithResponse($response);

        $this->assertInstanceOf(Gegevensdienstnamenlijst::class, $client->getGegevensdienstnamenlijst());
    }
}
