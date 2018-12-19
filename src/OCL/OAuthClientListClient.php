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
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use MedMij\OpenPGO\Client\MedMijClient;

class OAuthClientListClient extends MedMijClient
{
    /**
     * @param HttpClient $httpClient
     * @param string     $endpoint
     */
    public function __construct(HttpClient $httpClient, string $endpoint)
    {
        parent::__construct($httpClient, $endpoint, file_get_contents(__DIR__.'/../../Resources/xsd/MedMij_OAuthclientlist.xsd'));
    }

    /**
     * @return OAuthClientList
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOAuthClientList(): OAuthClientList
    {
        $response = $this->httpClient->request('GET', $this->endpoint);
        $this->assertXmlContentType($response);

        $document = new \DOMDocument();
        $xml = $response->getBody()->getContents();
        $document->loadXML($xml);
        $this->assertValidSchema($document);

        /** @var Serializer $serializer */
        $serializer = SerializerBuilder::create()->build();

        return $serializer->deserialize($xml, OAuthClientList::class, 'xml');
    }
}
