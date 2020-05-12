<?php

declare(strict_types=1);

namespace Mmm\Folder;

abstract class FolderOperations
{
    /** @var array */
    protected $folders;

    /** @var array */
    protected $files;

    /** @var PrependPath */
    protected $absolutePather;

    public function __construct()
    {
        $this->absolutePather = new PrependPath();
    }

    protected function reset(): void
    {
        $this->folders = $this->files = null;
        $this->absolutePather->setPath($this->getPath());
    }

    protected function scanIfNotScanned(): void
    {
        if ($this->folders === null || $this->files === null) {
            $this->scan();
        }
    }

    public function scan(): void
    {
        $this->folders = [];
        $this->files = [];

        foreach (scandir($this->getPath()) as $entry) {
            if (is_dir(($this->absolutePather)($entry))) {
                $this->folders[$entry] = $entry;
            } else {
                $this->files[$entry] = $entry;
            }
        }

        unset($this->folders['.']);
        unset($this->folders['..']);
    }

    public function getFolders(): array
    {
        $this->scanIfNotScanned();

        return $this->folders;
    }

    public function getAbsoluteFolders(): array
    {
        return array_map($this->absolutePather, $this->getFolders());
    }

    public function getFiles(): array
    {
        $this->scanIfNotScanned();

        return $this->files;
    }

    public function getAbsoluteFiles(): array
    {
        return array_map($this->absolutePather, $this->getFiles());
    }

    abstract public function getPath(): string;
}
