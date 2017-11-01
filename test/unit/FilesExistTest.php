<?php

namespace SendGrid\Test;

class FilesExistTest extends \PHPUnit_Framework_TestCase
{
    public function testFileArePresentInRepo()
    {
        $this->assertFileExists('./.gitignore');
        $this->assertFileExists('./.env_sample');
        $this->assertFileExists('./.travis.yml');
        $this->assertFileExists('./.codeclimate.yml');
        $this->assertFileExists('./CHANGELOG.md');
        $this->assertFileExists('./CODE_OF_CONDUCT.md');
        $this->assertFileExists('./CONTRIBUTING.md');
        $this->assertFileExists('./.github/ISSUE_TEMPLATE');
        $this->assertFileExists('./LICENSE.md');
        $this->assertFileExists('./.github/PULL_REQUEST_TEMPLATE');
        $this->assertFileExists('./README.md');
        $this->assertFileExists('./TROUBLESHOOTING.md');
        $this->assertFileExists('./USAGE.md');
        $this->assertFileExists('./USE_CASES.md');

        $composeExists = file_exists('./docker-compose.yml') || file_exists('./docker/docker-compose.yml');
        $this->assertTrue($composeExists);

        $dockerExists = file_exists('./Docker') || file_exists('./docker/Docker');
        $this->assertTrue($dockerExists);
    }
}

