<?php

declare(strict_types = 1);

namespace MmmTest\Folder;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\ActiveSubFolder;
use Mmm\Folder\Exception\NotFoundException;
use Mmm\Folder\Exception\OutOfBaseException;
use PHPUnit\Framework\TestCase;

class FolderTest extends TestCase
{
    private $dummy1Folder = 'dummy1';
    private $dummy1Folders = ['subdummy1'];
    private $dummy1Files = ['dummy1.txt'];
    private $subdummy1Folder = 'subdummy1';
    private $subdummy1Folders = [];
    private $subdummy1Files = ['subdummy1.txt'];

    public function testFolder()
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;

        $af = new ActiveFolder($path);

        $this->assertEquals($af->getCurrent(), $path);
        $this->assertEquals($af->getPath(), $path);
        $this->assertEquals($af->getFolders(), array_combine($this->dummy1Folders, $this->dummy1Folders));
        $this->assertEquals($af->getFiles(), array_combine($this->dummy1Files, $this->dummy1Files));
    }

    public function testNonFoundFolder()
    {
        $this->expectException(NotFoundException::class);

        $af = new ActiveFolder(__DIR__ . DIRECTORY_SEPARATOR . 'notFound');
    }

    public function testSubFolder()
    {
        $base = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $current = $this->subdummy1Folder;

        $asf = new ActiveSubFolder($base, $current);

        $this->assertEquals($asf->getBase(), $base);
        $this->assertEquals($asf->getCurrent(), $current);
        $this->assertEquals($asf->getPath(), $base . DIRECTORY_SEPARATOR . $current);
        $this->assertEquals($asf->getFolders(), array_combine($this->subdummy1Folders, $this->subdummy1Folders));
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
