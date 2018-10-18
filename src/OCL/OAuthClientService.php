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

class OAuthClientService
{
    /**
     * @var OAuthClientListClient
     */
    private $client;

    /**
     * @param OAuthClientListClient $client
     */
    public function __construct(OAuthClientListClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $hostname
     *
     * @throws OAuthClientNotFoundException
     *
     * @return OAuthClient
     */
    public function getOAuthClientByHostname(string $hostname): OAuthClient
    {
        /** @var OAuthClientList $oAuthClientList */
        $oAuthClientList = $this->client->getOAuthClientList();
        foreach ($oAuthClientList->getOAuthClients() as $oAuthClient) {
            if ($hostname === $oAuthClient->getHostname()) {
                return $oAuthClient;
            }
        }

        throw OAuthClientNotFoundException::withHostname($hostname);
    }
}
