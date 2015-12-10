# 500px Provider for OAuth 1.0 Client

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a67343ec-185c-4f65-b1bb-c72d61a303d2/mini.png)](https://insight.sensiolabs.com/projects/a67343ec-185c-4f65-b1bb-c72d61a303d2)
[![Coverage Status](https://coveralls.io/repos/monsieurmechant/oauth1-500px/badge.svg?branch=master&service=github)](https://coveralls.io/github/monsieurmechant/oauth1-500px?branch=master)
[![Build Status](https://travis-ci.org/monsieurmechant/oauth1-500px.svg)](https://travis-ci.org/monsieurmechant/oauth1-500px)

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
