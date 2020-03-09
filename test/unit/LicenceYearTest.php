<?php

namespace SendGrid\Test;

class LicenceYearTest extends \PHPUnit_Framework_TestCase
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
