<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\OAuth;

use GuzzleHttp\Client as HttpClient;
use MedMij\OpenPGO\OCL\OAuthClient;
use MedMij\OpenPGO\ZAL\Gegevensdienst;

class ZorgaanbiederProviderFactory
{
    /**
     * @param OAuthClient $oAuthClient
     * @param Gegevensdienst $gegevensdienst
     * @param HttpClient|null $httpClient
     *
     * @return ZorgaanbiederProvider
     */
    public function create(OAuthClient $oAuthClient, Gegevensdienst $gegevensdienst, HttpClient $httpClient = null): ZorgaanbiederProvider
    {
        return new ZorgaanbiederProvider([
            'clientId' => $oAuthClient->getHostname(),
            'urlAuthorize' => (string)$gegevensdienst->getAuthorizationEndpoint(),
            'urlAccessToken' => (string)$gegevensdienst->getTokenEndpoint(),
            'urlResourceOwnerDetails' => '', // @todo not required?
            'scopes' => 'ABC', // @todo use proper scope
        ], [
            'httpClient' => $httpClient,
        ]);
    }
}
