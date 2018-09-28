[![Build Status](https://travis-ci.org/GidsOpenStandaarden/OpenPGO-Medmij-ImplementatieBouwstenen-PHP.svg?branch=master)](https://travis-ci.org/GidsOpenStandaarden/OpenPGO-Medmij-ImplementatieBouwstenen-PHP)

gids-open-standaarden/open-pgo-medmij-implementatie-bouwstenen-php
==================================================================

PHP implementation of the MedMij OpenPGO building blocks.

# Installation

The OpenPGO PHP adapter can be installed using [Composer](https://getcomposer.org/):

```
$ composer require gids-open-standaarden/open-pgo-medmij-implementatie-bouwstenen-php
```

# Configuration

The building blocks use a HTTP client ([Guzzle](https://github.com/guzzle/guzzle)) to
connect.

For example the Whitelist client can be constructed like this:

```php
$whitelistClient = new \MedMij\OpenPGO\Whitelist\WhitelistClient(
    new \GuzzleHttp\Client(),
    'whitelist endpoint'
);
```

# Use cases

## Retrieve Whitelist

see https://github.com/GidsOpenStandaarden/OpenPGO/blob/master/Resources/UCI%20Opvragen%20Whitelist.pdf

The `WhitelistClient` can be used to retrieve the `Whitelist`.

```php
$whitelist = $whitelistClient->getWhitelist();
```

The `WhitelistService` provides a convenience method `isMedMijNodeWhitelisted` to check if a given node is whitelisted.

```php
$service = new \MedMij\OpenPGO\Whitelist\WhitelistService($whitelistClient);

$service->isMedMijNodeWhitelisted('specimen-stelselnode.medmij.nl');
```

## Retrieve OCL

see https://github.com/GidsOpenStandaarden/OpenPGO/blob/master/Resources/UCI%20Opvragen%20OCL.pdf

The `OAuthClientListClient` can be used to retrieve the `OAuthclientlist`.

```php
$client = new \MedMij\OpenPGO\OCL\OAuthClientListClient(
    new \GuzzleHttp\Client(),
    'OAuth Client List endpoint'
);

$client->getOAuthClientList();
```

## Retrieve ZAL

see https://github.com/GidsOpenStandaarden/OpenPGO/blob/master/Resources/UCI%20Opvragen%20ZAL.pdf

The `ZALClient` can be used to retrieve the `Zorgaanbiederslijst`.

```php
$client = new \MedMij\OpenPGO\ZAL\ZALClient(
    new \GuzzleHttp\Client(),
    'ZAL endpoint'
);

$client->getZAL();
```

## OAuth

This library provides the building blocks for [Three Legged OAuth 2](http://oauthbible.com/#oauth-2-three-legged) authentication.

A PGO GW can authenticate with a ZA GW using a `ZorgaanbiederProvider` which is configured with
* an OAuthclient as listed in the OAuthClientList
* a Gegevensdienst as listed in the Zorgaanbiederslijst.

```php
$oAuthClient = new OAuthClient('medmij.deenigeechtepgo.nl', 'De Enige Echte PGO');

$gegevensdienst = new Gegevensdienst(
    '4',
    new AuthorizationEndpoint('https://medmij.nl/dialog/oauth'),
    new TokenEndpoint('https://medmij.nl/token'),
    []
);

$zorgaanbieder = (new ZorgaanbiederProviderFactory())->create($oAuthClient, $gegevensdienst);
```

### Step 1. Application redirects User to Service for Authorization

```php
header('Location: ' . $provider->getAuthorizationUrl();
exit;
```

Note: store the state ($provider->getState()) to prevent replay attacks.

### Step 2. User logs into the Service and grants Application access.

### Step 3. Service redirects User back to the redirect_url.

### Step 4. Application takes the code and exchanges it for an Access Token

```php
$provider->getAccessToken('authorization_code', [
    'code' => '1234'
]);
```

# Development

Clone this repository and run  `composer install` to install the dependencies.

## Testing

This library is tested using [PHPUnit](https://phpunit.de/).

The tests can be executed with this command:

```
vendor/bin/phpunit
```
