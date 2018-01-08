<?php

namespace Mmm\Folder;

class PrependPath
{
    protected $path;

    public function setPath($path)
    {
        $this->path = $path;

        if ($path !== '') {
            $this->path .= DIRECTORY_SEPARATOR;
        }
    }

    public function __invoke($entry)
    {
        return $this->path . $entry;
    }
}
