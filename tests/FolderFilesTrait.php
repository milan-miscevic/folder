<?php

declare(strict_types=1);

namespace Mmm\Folder\Tests;

trait FolderFilesTrait
{
    private string $dummy1Folder = 'dummy1';

    /** @var string[] */
    private array $dummy1Folders = ['subdummy1'];

    /** @var string[] */
    private array $dummy1Files = ['dummy1.txt'];

    private string $subdummy1Folder = 'subdummy1';

    /** @var string[] */
    private array $subdummy1Folders = ['subsubdummy1'];

    /** @var string[] */
    private array $subdummy1Files = ['subdummy1.txt'];
}
