<?php

declare(strict_types=1);

namespace MmmTest\Folder;

use Mmm\Folder\ActiveSubfolder;
use Mmm\Folder\Exception\FolderNotFound;
use Mmm\Folder\Exception\OutOfBaseFolder;
use PHPUnit\Framework\TestCase;

class ActiveSubfolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testSubFolder(): void
    {
        $base = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $current = $this->subdummy1Folder;

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getBase(), $base);
        $this->assertEquals($asf->getCurrent(), $current);
        $this->assertEquals($asf->getPath(), $base . DIRECTORY_SEPARATOR . $current);
        $this->assertEquals($asf->getFolders(), array_combine($this->subdummy1Folders, $this->subdummy1Folders));
        $this->assertEquals($asf->getFiles(), array_combine($this->subdummy1Files, $this->subdummy1Files));
    }

    public function testNotFoundSubFolder(): void
    {
        $this->expectException(FolderNotFound::class);

        $asf = new ActiveSubfolder(__DIR__, 'notFound');
    }

    public function testOutOfBaseSubFolder(): void
    {
        $this->expectException(OutOfBaseFolder::class);

        $asf = new ActiveSubfolder(__DIR__, '..');
    }
}
