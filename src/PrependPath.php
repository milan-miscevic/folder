<?php

namespace Mmm\Folder;

class PrependPath
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function __invoke($entry)
    {
        return $this->path . DIRECTORY_SEPARATOR . $entry;
    }
}
