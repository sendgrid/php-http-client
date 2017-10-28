<?php

namespace SendGrid\Test;

class LicenceYearTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $license = explode("\n", file_get_contents('./LICENSE.txt'));
        $copyright = $license[2];

        $year = date('Y');

        $expected = "Copyright (c) 2012-{$year} SendGrid, Inc.";

        $this->assertEquals($expected, $copyright);
    }

}
