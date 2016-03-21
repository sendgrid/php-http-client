[![Travis Badge](https://travis-ci.org/sendgrid/php-http-client.svg?branch=master)](https://travis-ci.org/sendgrid/php-http-client)

**Quickly and easily access any REST or REST-like API.**

Here is a quick example:

`GET /your/api/{param}/call`

```php
require 'vendor/autoload.php';
$global_headers = array(Authorization: Basic XXXXXXX);
$client = SendGrid\Client('base_url', 'global_headers');
$response = $client->your()->api()->_($param)->call()->get();
print $response->statusCode();
print $response->responseHeaders();
print $response->responseBody();
```

`POST /your/api/{param}/call` with headers, query parameters and a request body with versioning.

```php
require 'vendor/autoload.php';
$global_headers = array(Authorization: Basic XXXXXXX);
$client = SendGrid\Client('base_url', 'global_headers');
$query_params = array('hello' => 0, 'world' => 1);
$request_headers = array('X-Test' => 'test');
$data = array('some' => 1, 'awesome' => 2, 'data' => 3);
$response = $client->your()->api()->_($param)->call()->post('data',
                                                            'query_params',
                                                            'request_headers');
print $response->statusCode();
print $response->responseHeaders();
print $response->responseBody();
```

# Installation

Add php-http-client to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application. 

```json
{  
  "require": {
    "sendgrid/php-http-client": "1.*"
  }
}
```

Then at the top of your PHP script require the autoloader:

```php
require __DIR__ . '/vendor/autoload.php';
```

Then from the command line:

```bash
composer install
```

## Usage ##

Following is an example using SendGrid. You can get your free account [here](https://sendgrid.com/free?source=php-http-client).

First, update your .env with your [SENDGRID_API_KEY](https://app.sendgrid.com/settings/api_keys) and HOST. For this example HOST=https://api.sendgrid.com.

Following is an abridged example, here is the [full working code](https://github.com/sendgrid/php-http-client/tree/master/examples).

```php
<?php
require __DIR__ . '/vendor/autoload.php';
$config = new SendGrid\Config(getcwd(), '.env');
$api_key = getenv('SENDGRID_API_KEY');
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$api_key
);
$client = new SendGrid\Client('https://api.sendgrid.com', $headers, '/v3', null);

// GET Collection
$query_params = array('limit' => 100, 'offset' => 0);
$request_headers = array('X-Mock: 200');
$response = $client->api_keys()->get(null, $query_params, $request_headers);

// POST
$request_body = array(
        'name' => 'My PHP API Key',
        'scopes' => array(
            'mail.send',
            'alerts.create',
            'alerts.read'
        )
);
$response = $client->api_keys()->post($request_body);
$response_body = json_decode($response->responseBody());
$api_key_id = $response_body->api_key_id;

// GET Single
$response = $client->version('/v3')->api_keys()->_($api_key_id)->get();

// PATCH
$request_body = array(
        'name' => 'A New Hope'
);
$response = $client->api_keys()->_($api_key_id)->patch($request_body);

// PUT
$request_body = array(
        'name' => 'A New Hope',
        'scopes' => array(
            'user.profile.read',
            'user.profile.update'
        )
);
$response = $client->api_keys()->_($api_key_id)->put($request_body);

// DELETE
$response = $client->api_keys()->_($api_key_id)->delete();
?>
```

# Announcements

[2016.03.28] - We hit version 1!

# Roadmap

[Milestones](https://github.com/sendgrid/php-http-client/milestones)

# How to Contribute

We encourage contribution to our libraries, please see our [CONTRIBUTING](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md) guide for details.

* [Feature Request](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#feature_request)
* [Bug Reports](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#submit_a_bug_report)
* [Improvements to the Codebase](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#improvements_to_the_codebase)

# Thanks

We were inspired by the work done on [birdy](https://github.com/inueni/birdy) and [universalclient](https://github.com/dgreisen/universalclient).

# About

![SendGrid Logo]
(https://assets3.sendgrid.com/mkt/assets/logos_brands/small/sglogo_2015_blue-9c87423c2ff2ff393ebce1ab3bd018a4.png)

php-http-client is guided and supported by the SendGrid [Developer Experience Team](mailto:dx@sendgrid.com).

php-http-client is maintained and funded by SendGrid, Inc. The names and logos for python-http-client are trademarks of SendGrid, Inc.
