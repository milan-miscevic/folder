<?php

declare(strict_types=1);

namespace Mmm\Folder;

abstract class FolderOperations
{
    protected bool $scanned = false;

    /** @var array<string, string> */
    protected array $folders = [];

    /** @var array<string, string> */
    protected array $files = [];

    protected PrependPath $absolutePather;

    public function __construct()
    {
        $this->absolutePather = new PrependPath();
    }

    protected function reset(): void
    {
        $this->folders = $this->files = [];
        $this->scanned = false;
        $this->absolutePather->setPath($this->getPath());
    }

    protected function scanIfNotScanned(): void
    {
        if (!$this->scanned) {
            $this->scan();
            $this->scanned = true;
        }
    }

    public function scan(): void
    {
        $this->folders = [];
        $this->files = [];

        $entries = @scandir($this->getPath());

        if ($entries === false) {
            throw new Exception\InvalidFolder();
        }

        foreach ($entries as $entry) {
            if (is_dir(($this->absolutePather)($entry))) {
                $this->folders[$entry] = $entry;
            } else {
                $this->files[$entry] = $entry;
            }
        }

        unset($this->folders['.']);
        unset($this->folders['..']);

        $this->scanned = true;
    }

    /**
     * @return array<string, string>
     */
    public function getFolders(): array
    {
        $this->scanIfNotScanned();

        return $this->folders;
    }

    /**
     * @return array<string, string>
     */
    public function getAbsoluteFolders(): array
    {
        return array_map($this->absolutePather, $this->getFolders());
    }

    /**
     * @return array<string, string>
     */
    public function getFiles(): array
    {
        $this->scanIfNotScanned();

        return $this->files;
    }

    /**
     * @return array<string, string>
     */
    public function getAbsoluteFiles(): array
    {
        return array_map($this->absolutePather, $this->getFiles());
    }

    abstract public function getPath(): string;
}
