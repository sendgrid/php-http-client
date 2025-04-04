<?php

namespace SendGrid\Test;

use SendGrid\Client;

class MockClient extends Client
{
    public $requestBody;
    public $requestHeaders;
    public $url;

    public function makeRequest($method, $url, ?array $requestBody = null, ?array $requestHeaders = null, $retryOnLimit = false)
    {
        $this->requestBody = $requestBody;
        $this->requestHeaders = $requestHeaders;
        $this->url = $url;
        return $this;
    }
}
