<?php

namespace SendGrid\Test;

use PHPUnit\Framework\TestCase;

class LicenceYearTest extends TestCase
{
    public function testConstructor()
    {
        $rootDir = __DIR__ . '/../..';

        $license = explode("\n", file_get_contents("$rootDir/LICENSE.txt"));
        $copyright = trim($license[2]);

        $year = date('Y');

        $expected = "Copyright (c) 2012-{$year} SendGrid, Inc.";

        $this->assertEquals($expected, $copyright);
    }
}
