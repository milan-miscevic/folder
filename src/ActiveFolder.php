<?php

declare(strict_types=1);

namespace Mmm\Folder;

class ActiveFolder extends FolderOperations
{
    protected string $current;

    public function __construct(string $current = '.')
    {
        parent::__construct();

        $this->setCurrent($current);
    }

    public function setCurrent(string $current): void
    {
        $current = realpath($current);

        if ($current !== false) {
            $this->current = $current;
        } else {
            throw new Exception\FolderNotFound();
        }

        $this->reset();
    }

    public function getCurrent(): string
    {
        return $this->current;
    }

    public function getPath(): string
    {
        return $this->getCurrent();
    }
}
