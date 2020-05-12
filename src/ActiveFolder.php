<?php

declare(strict_types=1);

namespace Mmm\Folder;

use Mmm\Folder\Exception\NotFoundException;

class ActiveFolder extends FolderOperations
{
    protected $current;

    public function __construct($current = '.')
    {
        parent::__construct();

        $this->setCurrent($current);
    }

    public function setCurrent($current)
    {
        $this->current = realpath($current);

        if ($this->current === false) {
            throw new NotFoundException();
        }

        $this->reset();
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
