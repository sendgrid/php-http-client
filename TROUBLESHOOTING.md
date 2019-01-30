If you can't find a solution below, please open an [issue](https://github.com/sendgrid/php-http-client/issues).

## Table of Contents

* [Viewing the Request Body](#request-body)

<a name="request-body"></a>
## Viewing the Request Body

When debugging or testing, it may be useful to examine the raw request body. In the `examples/example.php` file, after your API call use this code to echo out the statuscode, body and headers:

```php
echo $response->statusCode();
echo $response->body();
echo $response->headers();
```

Sometimes it is critical to know whether you request success or not. You can handle it by forcing to throw exceptions if something goes wrong instead of checking HTTP status code:

```php
$client = new SendGrid\Client('https://api.sendgrid.com', $headers, '/v3');
$client->setThrowException(true);

try {
   $response = $client->api_keys()->get(null, $query_params, $request_headers);
}
catch(SendGrid\ClientException $e) {
    // Do some log routines or just print out error to STDOUT
    var_dump(
        $e->getErrors(),
        $e->getHttpStatus(),
        $e->getShortTrace());
    exit;
}
```
