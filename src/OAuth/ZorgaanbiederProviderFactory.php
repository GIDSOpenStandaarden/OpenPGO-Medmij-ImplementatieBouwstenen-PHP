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

namespace MedMij\OpenPGO\OAuth;

use GuzzleHttp\Client as HttpClient;
use MedMij\OpenPGO\OCL\OAuthClient;
use MedMij\OpenPGO\ZAL\Gegevensdienst;

class ZorgaanbiederProviderFactory
{
    /**
     * @param OAuthClient     $oAuthClient
     * @param Gegevensdienst  $gegevensdienst
     * @param HttpClient|null $httpClient
     *
     * @return ZorgaanbiederProvider
     */
    public function create(OAuthClient $oAuthClient, Gegevensdienst $gegevensdienst, HttpClient $httpClient = null): ZorgaanbiederProvider
    {
        return new ZorgaanbiederProvider([
            'clientId' => $oAuthClient->getHostname(),
            'urlAuthorize' => (string) $gegevensdienst->getAuthorizationEndpoint(),
            'urlAccessToken' => (string) $gegevensdienst->getTokenEndpoint(),
            'urlResourceOwnerDetails' => '', // @todo not required?
            'scopes' => 'ABC', // @todo use proper scope
        ], [
            'httpClient' => $httpClient,
        ]);
    }
}
