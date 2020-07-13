<?php

namespace SendGrid\Test;

use PHPUnit\Framework\TestCase;

class LicenceYearTest extends TestCase
{
    public function testConstructor()
    {
        $rootDir = __DIR__ . '/../..';

        $license = explode("\n", file_get_contents("$rootDir/LICENSE.md"));
        $copyright = trim($license[2]);

        $year = date('Y');

        $expected = "Copyright (C) {$year}, Twilio SendGrid, Inc. <help@twilio.com>";

        $this->assertEquals($expected, $copyright);
    }
}
