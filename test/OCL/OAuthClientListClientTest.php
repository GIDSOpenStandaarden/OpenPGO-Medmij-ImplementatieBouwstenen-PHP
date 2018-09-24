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

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MedMij\OpenPGO\Client\InvalidContentTypeException;
use MedMij\OpenPGO\Client\InvalidXmlException;
use MedMij\OpenPGO\Client\MedMijClientTest;

class OAuthClientListClientTest extends MedMijClientTest
{
    /**
     * @param Response $response
     *
     * @return OAuthClientListClient
     */
    protected function createMockClientWithResponse(Response $response): OAuthClientListClient
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        return new OAuthClientListClient($httpClient, '/endpoint');
    }

    /**
     * @test
     */
    public function it_throws_when_content_type_is_not_xml()
    {
        $this->expectException(InvalidContentTypeException::class);

        $client = $this->createMockClientWithResponse(new Response(200, ['Content-Type' => 'text/plain']));
        $client->getOAuthClientList();
    }

    /**
     * @test
     */
    public function it_throws_when_xml_not_validated_against_xsd()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<OAuthclientlist xmlns="xmlns://afsprakenstelsel.medmij.nl/oauthclientlist/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/oauthclientlist/release2/MedMij_OAuthclientlist.xsd">
    <Tijdstempel>2018-04-16T11:41:59Z</Tijdstempel>
    <Volgnummer>522</Volgnummer>
    <OAuthclients>
        <OAuthclient>
            <Hostname>medmij.deenigeechtepgo.nl</Hostname>
            <OAuthclientOrganisatienaam>De Enige Echte PGO</OAuthclientOrganisatienaam>
        </OAuthclient>
        <OAuthclient>
            <Hostname>medmij.deenigeechtepgo.nl</Hostname>
            <OAuthclientOrganisatienaam>Unstealth Health Midden-Nederland</OAuthclientOrganisatienaam>
        </OAuthclient>
    </OAuthclients>
</OAuthclientlist>');
        $client = $this->createMockClientWithResponse($response);

        $this->expectException(InvalidXmlException::class);

        $client->getOAuthClientList();
    }

    /**
     * @test
     */
    public function it_gets_an_oauth_client_list()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<OAuthclientlist xmlns="xmlns://afsprakenstelsel.medmij.nl/oauthclientlist/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/oauthclientlist/release2/MedMij_OAuthclientlist.xsd">
    <Tijdstempel>2018-04-16T11:41:59Z</Tijdstempel>
    <Volgnummer>522</Volgnummer>
    <OAuthclients>
        <OAuthclient>
            <Hostname>medmij.deenigeechtepgo.nl</Hostname>
            <OAuthclientOrganisatienaam>De Enige Echte PGO</OAuthclientOrganisatienaam>
        </OAuthclient>
        <OAuthclient>
            <Hostname>pgocluster68.personalhealthprovider.net</Hostname>
            <OAuthclientOrganisatienaam>Unstealth Health Midden-Nederland</OAuthclientOrganisatienaam>
        </OAuthclient>
    </OAuthclients>
</OAuthclientlist>');
        $client = $this->createMockClientWithResponse($response);

        $this->assertInstanceOf(OAuthClientList::class, $client->getOAuthClientList());
    }
}
