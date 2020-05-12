<?php

declare(strict_types=1);

namespace MmmTest\Folder;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\ActiveSubfolder;
use Mmm\Folder\Exception\NotFoundException;
use Mmm\Folder\Exception\OutOfBaseException;
use PHPUnit\Framework\TestCase;

class ActiveSubfolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testSubFolder()
    {
        $base = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $current = $this->subdummy1Folder;

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getBase(), $base);

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getCurrent(), $current);

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getPath(), $base . DIRECTORY_SEPARATOR . $current);

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getFolders(), array_combine($this->subdummy1Folders, $this->subdummy1Folders));

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($asf->getFiles(), array_combine($this->subdummy1Files, $this->subdummy1Files));
    }

    public function testNotFoundSubFolder()
    {
        $this->expectException(NotFoundException::class);

        $asf = new ActiveSubfolder(__DIR__, 'notFound');
    }

    public function testOutOfBaseSubFolder()
    {
        $this->expectException(OutOfBaseException::class);

        $asf = new ActiveSubfolder(__DIR__, '..');
    }
}
