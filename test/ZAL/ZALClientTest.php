<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\ZAL;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MedMij\OpenPGO\Client\InvalidContentTypeException;
use MedMij\OpenPGO\Client\InvalidXmlException;
use MedMij\OpenPGO\Client\MedMijClientTest;

class ZALClientTest extends MedMijClientTest
{
    /**
     * @param Response $response
     *
     * @return ZALClient
     */
    protected function createMockClientWithResponse(Response $response): ZALClient
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);

        return new ZALClient($httpClient, '/endpoint');
    }

    /**
     * @test
     */
    public function it_throws_when_content_type_is_not_xml()
    {
        $this->expectException(InvalidContentTypeException::class);

        $client = $this->createMockClientWithResponse(new Response(200, ['Content-Type' => 'text/plain']));
        $client->getZAL();
    }

    /**
     * @test
     */
    public function it_throws_when_xml_not_validated_against_xsd()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Zorgaanbiederslijst xmlns="xmlns://afsprakenstelsel.medmij.nl/zorgaanbiederslijst/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/zorgaanbiederslijst/release2/ MedMij_Zorgaanbiederslijst.xsd">   
    <Tijdstempel>2018-04-16T12:56:33Z</Tijdstempel>
    <Volgnummer>6</Volgnummer>
    <Zorgaanbieders>
        <Zorgaanbieder>
            <Zorgaanbiedernaam>radiologencentraalflevoland@</Zorgaanbiedernaam>
            <Gegevensdiensten>
                <Gegevensdienst>
                    <GegevensdienstId>1</GegevensdienstId>
                    <AuthorizationEndpoint>
                        <AuthorizationEndpointuri>https://medmij.za983.xisbridge.net/oauth/authorize</AuthorizationEndpointuri>
                    </AuthorizationEndpoint>
                    <TokenEndpoint>
                        <TokenEndpointuri>https://medmij.xisbridge.net/oauth/token</TokenEndpointuri>
                    </TokenEndpoint>
                    <Systeemrollen>
                        <Systeemrol>
                            <Systeemrolcode>MM-1.0.0-BZB-FHIR</Systeemrolcode>
                            <ResourceEndpoint>
                                <ResourceEndpointuri>https://rcf-rso.nl/rcf/fhir-stu3</ResourceEndpointuri>
                            </ResourceEndpoint>
                        </Systeemrol>
                    </Systeemrollen>
                </Gegevensdienst>
            </Gegevensdiensten>
        </Zorgaanbieder>
    </Zorgaanbieders>
</Zorgaanbiederslijst>');
        $client = $this->createMockClientWithResponse($response);

        $this->expectException(InvalidXmlException::class);

        $client->getZAL();
    }

    /**
     * @test
     */
    public function it_gets_a_zorgaanbiederslijst()
    {
        $response = $this->createXmlResponseWithBody('<?xml version="1.0" encoding="UTF-8"?>
<!--File version: 2-->
<Zorgaanbiederslijst xmlns="xmlns://afsprakenstelsel.medmij.nl/zorgaanbiederslijst/release2/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="xmlns://afsprakenstelsel.medmij.nl/zorgaanbiederslijst/release2/ MedMij_Zorgaanbiederslijst.xsd">   
    <Tijdstempel>2018-04-16T12:56:33Z</Tijdstempel>
    <Volgnummer>6</Volgnummer>
    <Zorgaanbieders>
        <Zorgaanbieder>
            <Zorgaanbiedernaam>umcharderwijk@medmij</Zorgaanbiedernaam>
            <Gegevensdiensten>
                <Gegevensdienst>
                    <GegevensdienstId>4</GegevensdienstId>
                    <AuthorizationEndpoint>
                        <AuthorizationEndpointuri>https://medmij.za982.xisbridge.net/oauth/authorize</AuthorizationEndpointuri>
                    </AuthorizationEndpoint>
                    <TokenEndpoint>
                        <TokenEndpointuri>https://medmij.xisbridge.net/oauth/token</TokenEndpointuri>
                    </TokenEndpoint>
                    <Systeemrollen>
                        <Systeemrol>
                            <Systeemrolcode>LAB-1.0.0-LRB-FHIR</Systeemrolcode>
                            <ResourceEndpoint>
                                <ResourceEndpointuri>https://medmij.za982.xisbridge.net/fhir</ResourceEndpointuri>
                            </ResourceEndpoint>
                        </Systeemrol>
                    </Systeemrollen>
                </Gegevensdienst>
                <Gegevensdienst>
                    <GegevensdienstId>6</GegevensdienstId>
                    <AuthorizationEndpoint>
                        <AuthorizationEndpointuri>https://78834.umcharderwijk.nl/oauth/authorize</AuthorizationEndpointuri>
                    </AuthorizationEndpoint>
                    <TokenEndpoint>
                        <TokenEndpointuri>https://78834.umcharderwijk.nl:8099/oauth/token</TokenEndpointuri>
                    </TokenEndpoint>
                    <Systeemrollen>
                        <Systeemrol>
                            <Systeemrolcode>MM-1.0.0-PLB-FHIR</Systeemrolcode>
                            <ResourceEndpoint>
                                <ResourceEndpointuri>https://78834.umcharderwijk.nl:9100/pdfa</ResourceEndpointuri>
                            </ResourceEndpoint>
                        </Systeemrol>
                        <Systeemrol>
                            <Systeemrolcode>MM-1.0.0-PDB-FHIR</Systeemrolcode>
                            <ResourceEndpoint>
                                <ResourceEndpointuri>https://78834.umcharderwijk.nl:9100/pdfa</ResourceEndpointuri>
                            </ResourceEndpoint>
                        </Systeemrol>
                    </Systeemrollen>
                </Gegevensdienst>
            </Gegevensdiensten>
        </Zorgaanbieder>
        <Zorgaanbieder>
            <Zorgaanbiedernaam>radiologencentraalflevoland@medmij</Zorgaanbiedernaam>
            <Gegevensdiensten>
                <Gegevensdienst>
                    <GegevensdienstId>1</GegevensdienstId>
                    <AuthorizationEndpoint>
                        <AuthorizationEndpointuri>https://medmij.za983.xisbridge.net/oauth/authorize</AuthorizationEndpointuri>
                    </AuthorizationEndpoint>
                    <TokenEndpoint>
                        <TokenEndpointuri>https://medmij.xisbridge.net/oauth/token</TokenEndpointuri>
                    </TokenEndpoint>
                    <Systeemrollen>
                        <Systeemrol>
                            <Systeemrolcode>MM-1.0.0-BZB-FHIR</Systeemrolcode>
                            <ResourceEndpoint>
                                <ResourceEndpointuri>https://rcf-rso.nl/rcf/fhir-stu3</ResourceEndpointuri>
                            </ResourceEndpoint>
                        </Systeemrol>
                    </Systeemrollen>
                </Gegevensdienst>
            </Gegevensdiensten>
        </Zorgaanbieder>
    </Zorgaanbieders>
</Zorgaanbiederslijst>');
        $client = $this->createMockClientWithResponse($response);

        $this->assertInstanceOf(Zorgaanbiederslijst::class, $client->getZAL());
    }
}
