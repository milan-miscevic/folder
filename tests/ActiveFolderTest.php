<?php

declare(strict_types=1);

namespace MmmTest\Folder;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\Exception\FolderNotFound;
use PHPUnit\Framework\TestCase;

class ActiveFolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testFolder(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;

        $af = new ActiveFolder($path);
        $this->assertEquals($af->getCurrent(), $path);
        $this->assertEquals($af->getPath(), $path);
        $this->assertEquals($af->getFolders(), array_combine($this->dummy1Folders, $this->dummy1Folders));
        $this->assertEquals($af->getFiles(), array_combine($this->dummy1Files, $this->dummy1Files));
    }

    public function testNonFoundFolder(): void
    {
        $this->expectException(FolderNotFound::class);

        $af = new ActiveFolder(__DIR__ . DIRECTORY_SEPARATOR . 'notFound');
    }
}
