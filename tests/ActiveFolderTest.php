<?php

declare(strict_types=1);

namespace MmmTest\Folder;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class ActiveFolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testFolder(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;

        $af = new ActiveFolder($path);
        $this->assertEquals($af->getCurrent(), $path);

        $af = new ActiveFolder($path);
        $this->assertEquals($af->getPath(), $path);

        $af = new ActiveFolder($path);
        $this->assertEquals($af->getFolders(), array_combine($this->dummy1Folders, $this->dummy1Folders));

        $af = new ActiveFolder($path);
        $this->assertEquals($af->getFiles(), array_combine($this->dummy1Files, $this->dummy1Files));
    }

    public function testNonFoundFolder(): void
    {
        $this->expectException(NotFoundException::class);

        $af = new ActiveFolder(__DIR__ . DIRECTORY_SEPARATOR . 'notFound');
    }
}
