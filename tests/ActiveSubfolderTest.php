<?php

declare(strict_types=1);

namespace Mmm\Folder\Tests;

use Mmm\Folder\ActiveSubfolder;
use Mmm\Folder\Exception\FolderNotFound;
use Mmm\Folder\Exception\OutOfBaseFolder;
use PHPUnit\Framework\TestCase;

class ActiveSubfolderTest extends TestCase
{
    use FolderFilesTrait;

    public function testGeneral(): void
    {
        $base = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $current = $this->subdummy1Folder;

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($base, $asf->getBase());
        $this->assertEquals($current, $asf->getCurrent());
        $this->assertEquals($base . DIRECTORY_SEPARATOR . $current, $asf->getPath());
        $this->assertEquals(array_combine($this->subdummy1Folders, $this->subdummy1Folders), $asf->getFolders());
        $this->assertEquals(array_combine($this->subdummy1Files, $this->subdummy1Files), $asf->getFiles());

        // relative paths

        $expected = [];

        foreach ($this->subdummy1Folders as $entry) {
            $expected[] = $current . DIRECTORY_SEPARATOR . $entry;
        }

        $this->assertEquals(array_combine($this->subdummy1Folders, $expected), $asf->getRelativeFolders());

        $expected = [];

        foreach ($this->subdummy1Files as $entry) {
            $expected[] = $current . DIRECTORY_SEPARATOR . $entry;
        }

        $this->assertEquals(array_combine($this->subdummy1Files, $expected), $asf->getRelativeFiles());

        // absolute paths

        $expected = [];

        foreach ($this->subdummy1Folders as $entry) {
            $expected[] = $base . DIRECTORY_SEPARATOR . $current . DIRECTORY_SEPARATOR . $entry;
        }

        $this->assertEquals(array_combine($this->subdummy1Folders, $expected), $asf->getAbsoluteFolders());

        $expected = [];

        foreach ($this->subdummy1Files as $entry) {
            $expected[] = $base . DIRECTORY_SEPARATOR . $current . DIRECTORY_SEPARATOR . $entry;
        }

        $this->assertEquals(array_combine($this->subdummy1Files, $expected), $asf->getAbsoluteFiles());
    }

    public function testBaseChange(): void
    {
        $base1 = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $base2 = $base1 . DIRECTORY_SEPARATOR . $this->subdummy1Folder;

        $asf = new ActiveSubfolder($base1);
        $this->assertEquals($base1, $asf->getBase());

        $asf->setBase($base2);
        $this->assertEquals($base2, $asf->getBase());
    }

    public function testCurrentChange(): void
    {
        $base = __DIR__ . DIRECTORY_SEPARATOR . $this->dummy1Folder;
        $current = $this->subdummy1Folder;

        $asf = new ActiveSubfolder($base, $current);
        $this->assertEquals($current, $asf->getCurrent());

        $asf->setCurrent('.');
        $this->assertEquals('', $asf->getCurrent());

        $asf->setCurrent('');
        $this->assertEquals('', $asf->getCurrent());
    }

    public function testBaseFolderNotFound(): void
    {
        $this->expectException(FolderNotFound::class);

        $asf = new ActiveSubfolder('notFound');
    }

    public function testCurrentFolderNotFound(): void
    {
        $this->expectException(FolderNotFound::class);

        $asf = new ActiveSubfolder(__DIR__, 'notFound');
    }

    public function testOutOfBaseFolder(): void
    {
        $this->expectException(OutOfBaseFolder::class);

        $asf = new ActiveSubfolder(__DIR__, '..');
    }
}
