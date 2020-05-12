<?php

declare(strict_types=1);

namespace Mmm\Folder;

class ActiveSubfolder extends FolderOperations
{
    /** @var string */
    protected $base;

    /** @var string */
    protected $current;

    /** @var PrependPath */
    protected $relativePather;

    public function __construct(string $base = '.', string $current = '')
    {
        parent::__construct();

        $this->relativePather = new PrependPath();

        $this->setRealBase($base);
        $this->setRealCurrent($current);
        $this->reset();
    }

    public function setBase(string $base): void
    {
        $this->setRealBase($base);
        $this->reset();
    }

    protected function setRealBase(string $base): void
    {
        $base = realpath($base);

        if ($base !== false) {
            $this->base = $base;
        } else {
            throw new Exception\FolderNotFound();
        }
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function setCurrent(string $current): void
    {
        $this->setRealCurrent($current);
        $this->reset();
    }

    protected function setRealCurrent(string $current): void
    {
        $path = realpath($this->base . DIRECTORY_SEPARATOR . $current);

        if ($path === false) {
            throw new Exception\FolderNotFound();
        }

        if (strpos($path, $this->base) !== 0) {
            throw new Exception\OutOfBaseFolder();
        }

        $this->current = (string) substr($path, strlen($this->base) + 1);
    }

    public function getCurrent(): string
    {
        return $this->current;
    }

    protected function reset(): void
    {
        parent::reset();

        $this->relativePather->setPath($this->current);
    }

    public function getRelativeFolders(): array
    {
        return array_map($this->relativePather, $this->getFolders());
    }

    public function getRelativeFiles(): array
    {
        return array_map($this->relativePather, $this->getFiles());
    }

    public function getPath(): string
    {
        if ($this->current === '') {
            return $this->base;
        }

        return $this->base . DIRECTORY_SEPARATOR . $this->current;
    }
}
