<?php

namespace Mmm\Folder;

use Mmm\Folder\Exception\NotFoundException;

class ActiveFolder extends FolderOperations
{
    protected $current;

    public function __construct($current = '.')
    {
        $this->setCurrent($current);
    }

    public function setCurrent($current)
    {
        $this->current = realpath($current);

        if ($this->current === false) {
            throw new NotFoundException();
        }

        $this->markUnscanned();
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function getPath()
    {
        return $this->getCurrent();
    }
}
