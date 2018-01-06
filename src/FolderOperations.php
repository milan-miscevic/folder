<?php

namespace Mmm\Folder;

abstract class FolderOperations
{
    protected $folders;
    protected $files;
    protected $absolutePather;

    public function __construct()
    {
        $this->absolutePather = new PrependPath();
    }

    protected function reset()
    {
        $this->folders = $this->files = null;
        $this->absolutePather->setPath($this->getPath());
    }

    protected function scanIfNotScanned()
    {
        if ($this->folders === null || $this->files === null) {
            $this->scan();
        }
    }

    public function scan()
    {
        $this->folders = [];
        $this->files = [];

        foreach (scandir($this->getPath()) as $entry) {
            if (is_dir(($this->absolutePather)($entry))) {
                $this->folders[] = $entry;
            } else {
                $this->files[] = $entry;
            }
        }
    }

    public function getFolders()
    {
        $this->scanIfNotScanned();

        return $this->folders;
    }

    public function getAbsoluteFolders()
    {
        return array_map($this->absolutePather, $this->getFolders());
    }

    public function getFiles()
    {
        $this->scanIfNotScanned();

        return $this->files;
    }

    public function getAbsoluteFiles()
    {
        return array_map($this->absolutePather, $this->getFiles());
    }

    abstract public function getPath();
}
