<?php

declare(strict_types=1);

namespace Mmm\Folder\Tests;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\Exception\FolderNotFound;
use Mmm\Folder\Exception\InvalidFolder;
use PHPUnit\Framework\TestCase;

class ActiveFolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testGeneral(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;

        $af = new ActiveFolder($path);
        $this->assertEquals($path, $af->getCurrent());
        $this->assertEquals($path, $af->getPath());
        $this->assertEquals(array_combine($this->dummy1Folders, $this->dummy1Folders), $af->getFolders());
        $this->assertEquals(array_combine($this->dummy1Files, $this->dummy1Files), $af->getFiles());
    }

    public function testFolderNotFound(): void
    {
        $this->expectException(FolderNotFound::class);

        new ActiveFolder(__DIR__ . DIRECTORY_SEPARATOR . 'notFound');
    }

    public function testInvalidFolder(): void
    {
        $this->expectException(InvalidFolder::class);

        $af = new ActiveFolder(__FILE__);
        $af->scan();
    }
}
