<?php

namespace SendGrid\Test;

class LicenseYearTest extends \PHPUnit_Framework_TestCase
{

    public function testLicenseYear()
    {
        $license = explode("\n", file_get_contents('../../LICENSE.txt'));
        $copyright = '';
        foreach ($license as $line) {
            if (strpos($line, 'Copyright') === 0) {
                $copyright = $line;
                break;
            }
        }
        $year = date('Y');
        $expected = "Copyright (c) 2016-{$year} SendGrid, Inc.";
        $this->assertEquals($expected, $copyright);
    }
}