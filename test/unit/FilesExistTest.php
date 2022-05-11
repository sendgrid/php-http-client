<?php

namespace SendGrid\Test;

use PHPUnit\Framework\TestCase;

class FilesExistTest extends TestCase
{
    public function testFileArePresentInRepo()
    {
        $rootDir = __DIR__ . '/../..';

        $this->assertFileExists("$rootDir/.gitignore");
        $this->assertFileExists("$rootDir/.github/workflows/test-and-deploy.yml");
        $this->assertFileExists("$rootDir/CHANGELOG.md");
        $this->assertFileExists("$rootDir/CODE_OF_CONDUCT.md");
        $this->assertFileExists("$rootDir/CONTRIBUTING.md");
        $this->assertFileExists("$rootDir/Dockerfile");
        $this->assertFileExists("$rootDir/LICENSE");
        $this->assertFileExists("$rootDir/PULL_REQUEST_TEMPLATE.md");
        $this->assertFileExists("$rootDir/README.md");
        $this->assertFileExists("$rootDir/TROUBLESHOOTING.md");
        $this->assertFileExists("$rootDir/USAGE.md");
    }
}
