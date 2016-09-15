<?php

namespace SendGrid\Test;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var MockClient */
    private $client;
    /** @var string */
    private $host;
    /** @var array */
    private $headers;
    
    protected function setUp()
    {
        $this->host = 'https://localhost:4010';
        $this->headers = [
            'Content-Type: application/json',
            'Authorization: Bearer SG.XXXX'
        ];
        $this->client = new MockClient($this->host, $this->headers, '/v3', null);
    }
    
    public function testConstructor()
    {
        $this->assertAttributeEquals($this->host, 'host', $this->client);
        $this->assertAttributeEquals($this->headers, 'headers', $this->client);
        $this->assertAttributeEquals('/v3', 'version', $this->client);
        $this->assertAttributeEquals([], 'path', $this->client);
        $this->assertAttributeEquals(['delete', 'get', 'patch', 'post', 'put'], 'methods', $this->client);
    }
    
    public function test_()
    {
        $client = $this->client->_('test');
        $this->assertAttributeEquals(['test'], 'path', $client);
    }
    
    public function test__call()
    {
        $client = $this->client->get();
        $this->assertAttributeEquals('https://localhost:4010/v3/', 'url', $client);

        $queryParams = ['limit' => 100, 'offset' => 0];
        $client = $this->client->get(null, $queryParams);
        $this->assertAttributeEquals('https://localhost:4010/v3/?limit=100&offset=0', 'url', $client);

        $requestBody = ['name' => 'A New Hope'];
        $client = $this->client->get($requestBody);
        $this->assertAttributeEquals($requestBody, 'requestBody', $client);

        $requestHeaders = ['X-Mock: 200'];
        $client = $this->client->get(null, null, $requestHeaders);
        $this->assertAttributeEquals($requestHeaders, 'requestHeaders', $client);

        $client = $this->client->version('/v4');
        $this->assertAttributeEquals('/v4', 'version', $client);

        $client = $this->client->path_to_endpoint();
        $this->assertAttributeEquals(['path_to_endpoint'], 'path', $client);
        $client = $client->one_more_segment();
        $this->assertAttributeEquals(['path_to_endpoint', 'one_more_segment'], 'path', $client);
    }
}