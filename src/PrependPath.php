<?php

declare(strict_types=1);

namespace Mmm\Folder;

class PrependPath
{
    /** @var string */
    protected $path;

    public function setPath(string $path): void
    {
        $this->path = $path;

        if ($path !== '') {
            $this->path .= DIRECTORY_SEPARATOR;
        }
    }

    public function __invoke(string $entry): string
    {
        return $this->path . $entry;
    }
}
