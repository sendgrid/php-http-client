![SendGrid Logo](https://uiux.s3.amazonaws.com/2016-logos/email-logo%402x.png)

[![Travis Badge](https://travis-ci.org/sendgrid/php-http-client.svg?branch=master)](https://travis-ci.org/sendgrid/php-http-client)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sendgrid/php-http-client.svg?style=flat-square)](https://packagist.org/packages/sendgrid/php-http-client)
[![npm](https://img.shields.io/npm/l/express.svg)]()
[![Twitter Follow](https://img.shields.io/twitter/follow/sendgrid.svg?style=social&label=Follow)](https://twitter.com/sendgrid)
[![GitHub contributors](https://img.shields.io/github/contributors/sendgrid/php-http-client.svg)](https://github.com/sendgrid/php-http-client/graphs/contributors)

**Quickly and easily access any RESTful or RESTful-like API.**

If you are looking for the SendGrid API client library, please see [this repo](https://github.com/sendgrid/sendgrid-php).

# Announcements

All updates to this library is documented in our [CHANGELOG](https://github.com/sendgrid/php-http-client/blob/master/CHANGELOG.md).

# Table of Contents
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Thanks](#thanks)
- [About](#about)

<a name="installation"></a>
# Installation

## Prerequisites

- PHP version 5.6 or 7.0

## Install with Composer

Add php-http-client to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application.

```json
{
  "require": {
    "sendgrid/php-http-client": "~3.8"
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

## Install without Composer

You should create directory `lib` in directory of your application and clone to `lib` repositories [php-http-client](https://github.com/sendgrid/php-http-client.git) and [sendgrid-php](https://github.com/sendgrid/sendgrid-php.git):

```
$ cd /path/to/your/app
$ mkdir lib
$ cd lib
$ git clone https://github.com/sendgrid/php-http-client.git
$ git clone https://github.com/sendgrid/sendgrid-php.git
```

In the next step you should create `loader.php`:

```
$ cd /path/to/your/app
$ touch loader.php
```

And add to `loader.php` code below:

```php
<?php

require_once __DIR__ . '/lib/php-http-client/lib/Client.php';
require_once __DIR__ . '/lib/php-http-client/lib/Response.php';
require_once __DIR__ . '/lib/sendgrid-php/lib/SendGrid.php';

```

After it you can use `php-http-client` library in your project:

```php
<?php

include __DIR__ . '/loader.php';

$client = new SendGrid\Client();
```

<a name="quick-start"></a>
# Quick Start

Here is a quick example:

`GET /your/api/{param}/call`

```php
// include __DIR__ . '/loader.php';
require 'vendor/autoload.php';
$global_headers = array(Authorization: Basic XXXXXXX);
$client = new SendGrid\Client('base_url', global_headers);
$response = $client->your()->api()->_($param)->call()->get();
print $response->statusCode();
print $response->headers();
print $response->body();
```

`POST /your/api/{param}/call` with headers, query parameters and a request body with versioning.

```php
// include __DIR__ . '/loader.php';
require 'vendor/autoload.php';
$global_headers = array(Authorization: Basic XXXXXXX);
$client = new SendGrid\Client('base_url', global_headers);
$query_params = array('hello' => 0, 'world' => 1);
$request_headers = array('X-Test' => 'test');
$data = array('some' => 1, 'awesome' => 2, 'data' => 3);
$response = $client->your()->api()->_($param)->call()->post('data',
                                                            'query_params',
                                                            'request_headers');
print $response->statusCode();
print $response->headers();
print $response->body();
```

<a name="usage"></a>
# Usage

- [Example Code](https://github.com/sendgrid/php-http-client/tree/master/examples)

## Roadmap

If you are interested in the future direction of this project, please take a look at our [milestones](https://github.com/sendgrid/php-http-client/milestones). We would love to hear your feedback.

## How to Contribute

We encourage contribution to our libraries, please see our [CONTRIBUTING](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md)) guide for details.

Quick links:

- [Feature Request](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#feature-request)
- [Bug Reports](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#submit-a-bug-report)
- [Sign the CLA to Create a Pull Request](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#cla)
- [Improvements to the Codebase](https://github.com/sendgrid/php-http-client/blob/master/CONTRIBUTING.md#improvements-to-the-codebase)

<a name="thanks"></a>
# Thanks

We were inspired by the work done on [birdy](https://github.com/inueni/birdy) and [universalclient](https://github.com/dgreisen/universalclient).

<a name="about"></a>
# About

php-http-client is guided and supported by the SendGrid [Developer Experience Team](mailto:dx@sendgrid.com).

php-http-client is maintained and funded by SendGrid, Inc. The names and logos for php-http-client are trademarks of SendGrid, Inc.

![SendGrid Logo](https://uiux.s3.amazonaws.com/2016-logos/email-logo%402x.png)
