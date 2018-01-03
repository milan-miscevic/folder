<?php

namespace Mmm\Folder;

use Mmm\Folder\Exception\NotFoundException;
use Mmm\Folder\Exception\OutOfBaseException;

class ActiveSubfolder extends FolderOperations
{
    protected $base;
    protected $current;

    public function __construct($base = '.', $current = '.')
    {
        $this->setBase($base);
        $this->setCurrent($current);
    }

    public function setBase($base)
    {
        $this->base = realpath($base);

        if ($this->base === false) {
            throw new NotFoundException();
        }

        $this->markUnscanned();
    }

    public function getBase()
    {
        return $this->base;
    }

    public function setCurrent($current)
    {
        $path = realpath($this->base . DIRECTORY_SEPARATOR . $current);

        if ($path === false) {
            throw new NotFoundException();
        }

        if (strpos($path, $this->base) !== 0) {
            throw new OutOfBaseException();
        }

        $this->current = (string) substr($path, strlen($this->base) + 1);

        $this->markUnscanned();
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function getPath()
    {
        return $this->base . DIRECTORY_SEPARATOR . $this->current;
    }
}
