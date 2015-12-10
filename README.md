# 500px Provider for OAuth 1.0 Client

This package provides a [500px](https://500px.com/) Client for the PHP League's [OAuth 1.0 Client](https://github.com/thephpleague/oauth1-client).

## Installation

```
composer require mechant/oauth1-500px
```

## Usage

Usage is the same as The League's OAuth client, using `Mechant\OAuth1\Client\Server\FiveHundredPx` as the provider.

```php
$server = new Mechant\OAuth1\Client\Server\FiveHundredPx([
    'identifier'   => 'your-client-id',
    'secret'       => 'your-client-secret',
    'callback_uri' => 'http://callback.url/callback',
]);
```

Please refer to the [500px Api Documentation](https://github.com/500px/api-documentation) for the available endpoints.