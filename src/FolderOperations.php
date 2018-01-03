<?php

namespace Mmm\Folder;

abstract class FolderOperations
{
    protected $folders;
    protected $files;
    protected $absolutePather;

    protected function scanIfNotScanned()
    {
        if ($this->folders === null || $this->files === null) {
            $this->scan();
        }
    }

    public function scan()
    {
        $path = $this->getPath();

        $this->folders = [];
        $this->files = [];
        $this->absolutePather = new PrependPath($path);

        foreach (scandir($path) as $entry) {
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

    protected function markUnscanned()
    {
        $this->folders = $this->files = null;
    }

    abstract public function getPath();
}
