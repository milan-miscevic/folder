<?php

declare(strict_types=1);

namespace Mmm\Folder\Tests;

use Mmm\Folder\ActiveFolder;
use Mmm\Folder\Exception\FolderNotFound;
use Mmm\Folder\Exception\InvalidFolder;
use PHPUnit\Framework\TestCase;

class ActiveFolderTest extends TestCase
{
    /** @var string */
    private $folder1 = 'folder1';

    /** @var string */
    private $folder2 = 'folder2';

    /** @var array<string, array<string, array<string, array<int, string>>>> */
    private $data = [
        'folder1' => [
            'folders' => [
                'names' => [
                    'folder11',
                    'folder12',
                ],
                'absolute' => [
                    'folder1' . DIRECTORY_SEPARATOR . 'folder11',
                    'folder1' . DIRECTORY_SEPARATOR . 'folder12',
                ],
            ],
            'files' => [
                'names' => [
                    'file11.txt',
                    'file12.txt',
                ],
                'absolute' => [
                    'folder1' . DIRECTORY_SEPARATOR . 'file11.txt',
                    'folder1' . DIRECTORY_SEPARATOR . 'file12.txt',
                ],
            ],
        ],
        'folder2' => [
            'folders' => [
                'names' => [
                    'folder21',
                    'folder22',
                ],
                'absolute' => [
                    'folder2' . DIRECTORY_SEPARATOR . 'folder21',
                    'folder2' . DIRECTORY_SEPARATOR . 'folder22',
                ],
            ],
            'files' => [
                'names' => [
                    'file21.txt',
                    'file22.txt',
                ],
                'absolute' => [
                    'folder2' . DIRECTORY_SEPARATOR . 'file21.txt',
                    'folder2' . DIRECTORY_SEPARATOR . 'file22.txt',
                ],
            ],
        ],
    ];

    public function testPath(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->folder1;
        $af = new ActiveFolder($path);

        $this->assertSame($path, $af->getCurrent());
        $this->assertSame($path, $af->getPath());
    }

    public function testFoldersFilesNames(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->folder1;
        $af = new ActiveFolder($path);

        $folders = array_combine(
            $this->data[$this->folder1]['folders']['names'],
            $this->data[$this->folder1]['folders']['names']
        );

        $this->assertSame($folders, $af->getFolders());

        $files = array_combine(
            $this->data[$this->folder1]['files']['names'],
            $this->data[$this->folder1]['files']['names']
        );

        $this->assertSame($files, $af->getFiles());
    }

    public function testFoldersFilesAbsolutePaths(): void
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->folder2;
        $af = new ActiveFolder($path);

        $folders = array_combine(
            $this->data[$this->folder2]['folders']['names'],
            array_map(
                function ($value) {
                    return __DIR__ . DIRECTORY_SEPARATOR . $value;
                },
                $this->data[$this->folder2]['folders']['absolute']
            )
        );

        $this->assertSame($folders, $af->getAbsoluteFolders());

        $files = array_combine(
            $this->data[$this->folder2]['files']['names'],
            array_map(
                function ($value) {
                    return __DIR__ . DIRECTORY_SEPARATOR . $value;
                },
                $this->data[$this->folder2]['files']['absolute']
            )
        );

        $this->assertSame($files, $af->getAbsoluteFiles());
    }

    public function testPathChange(): void
    {
        // the first folder

        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->folder1;
        $af = new ActiveFolder($path);

        $this->assertSame($path, $af->getCurrent());
        $this->assertSame($path, $af->getPath());

        $folders = array_combine(
            $this->data[$this->folder1]['folders']['names'],
            $this->data[$this->folder1]['folders']['names']
        );

        $this->assertSame($folders, $af->getFolders());

        // the second folder

        $path = __DIR__ . DIRECTORY_SEPARATOR . $this->folder2;

        $af->setCurrent($path);

        $this->assertSame($path, $af->getCurrent());
        $this->assertSame($path, $af->getPath());

        $folders = array_combine(
            $this->data[$this->folder2]['files']['names'],
            $this->data[$this->folder2]['files']['names']
        );

        $this->assertSame($folders, $af->getFiles());
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
