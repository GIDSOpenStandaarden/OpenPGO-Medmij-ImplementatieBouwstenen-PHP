<?php

declare(strict_types=1);

namespace MedMij\OpenPGO\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MedMij\OpenPGO\OCL\OAuthClient;
use MedMij\OpenPGO\ZAL\AuthorizationEndpoint;
use MedMij\OpenPGO\ZAL\Gegevensdienst;
use MedMij\OpenPGO\ZAL\TokenEndpoint;

class OAuthFlowTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array
     */
    private $httpClientTransactions = [];

    /**
     * @var ZorgaanbiederProvider
     */
    private $zorgaanbiederProvider;

    protected function setUp()
    {
        $oAuthClient = new OAuthClient('medmij.deenigeechtepgo.nl', 'De Enige Echte PGO');

        $gegevensdienst = new Gegevensdienst(
            '4',
            new AuthorizationEndpoint('https://medmij.nl/dialog/oauth'),
            new TokenEndpoint('https://medmij.nl/token'),
            []
        );

        $mock = new MockHandler([new Response(200, [], json_encode(['access_token' => 'my access token']))]);

        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->httpClientTransactions));

        $httpClient = new Client(['handler' => $stack]);

        $this->zorgaanbiederProvider = (new ZorgaanbiederProviderFactory())->create($oAuthClient, $gegevensdienst, $httpClient);
    }

    /**
     * @test
     *
     * Test case 1 from UCI OAuth
     */
    public function it_creates_a_redirect_url_to_zorgaanbieder()
    {
        $expectedUrl = 'https://medmij.nl/dialog/oauth?state=1234zyx&acr_values=ura%3A555&redirect_uri=https%3A%2F%2Fmedmij.deenigeechtepgo.nl%2Freturn_url&scope=ABC&response_type=code&approval_prompt=auto&client_id=medmij.deenigeechtepgo.nl';

        $this->assertEquals($expectedUrl, $this->zorgaanbiederProvider->getAuthorizationUrl([
            'state' => '1234zyx',
            'acr_values' => 'ura:555',
            'redirect_uri' => 'https://medmij.deenigeechtepgo.nl/return_url',
        ]));
    }

    /**
     * @test
     *
     * test case 2 from UCI OAuth
     */
    public function it_exchanges_an_auth_code_for_an_access_token()
    {
        $expectedTokenUrl = 'https://medmij.nl/token';
        $expectedTokenRequestBody = 'client_id=medmij.deenigeechtepgo.nl&grant_type=authorization_code&code=1234';

        $this->zorgaanbiederProvider->getAccessToken('authorization_code', [
            'code' => '1234',
        ]);

        /** @var Request $httpRequest */
        $httpRequest = $this->httpClientTransactions[0]['request'];

        $this->assertEquals('POST', $httpRequest->getMethod());
        $this->assertEquals($expectedTokenUrl, (string) $httpRequest->getUri());
        $this->assertEquals($expectedTokenRequestBody, $httpRequest->getBody()->getContents());
    }
}
