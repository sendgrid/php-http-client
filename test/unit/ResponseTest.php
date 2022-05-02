<?php

namespace SendGrid\Test;

use PHPUnit\Framework\TestCase;
use SendGrid\Response;

class ResponseTest extends TestCase
{
    public function testConstructor()
    {
        $response = new Response();

        $this->assertEquals(200, $response->statusCode());
        $this->assertEquals('', $response->body());
        $this->assertEquals([], $response->headers());

        $response = new Response(201, 'test', ['Content-Encoding: gzip']);

        $this->assertEquals(201, $response->statusCode());
        $this->assertEquals('test', $response->body());
        $this->assertEquals(['Content-Encoding: gzip'], $response->headers());
    }

    public function testStatusCode()
    {
        $response = new Response(404);

        $this->assertEquals(404, $response->statusCode());
    }

    public function testBody()
    {
        $response = new Response(null, 'foo');

        $this->assertEquals('foo', $response->body());
    }

    public function testHeaders()
    {
        $response = new Response(null, null, ['Content-Type: text/html']);

        $this->assertEquals(['Content-Type: text/html'], $response->headers());
    }

    public function testAssociativeHeaders()
    {
        $response = new Response(null, null, ['Content-Type: text/html', 'HTTP/1.1 200 OK']);

        $this->assertEquals(['Content-Type' => 'text/html', 'Status' => 'HTTP/1.1 200 OK'], $response->headers(true));
    }
}
