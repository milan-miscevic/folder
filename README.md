# folder

[![Software License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)

[![GitHub Build](https://github.com/milan-miscevic/folder/workflows/Test/badge.svg?branch=master)](https://github.com/milan-miscevic/folder/actions)
[![Type Coverage](https://shepherd.dev/github/milan-miscevic/folder/coverage.svg)](https://shepherd.dev/github/milan-miscevic/folder)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fmilan-miscevic%2Ffolder%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/milan-miscevic/folder/master)

A folder scanner.

## Usage

```php
use Mmm\Folder\ActiveFolder;
use Mmm\Folder\ActiveSubFolder;

$af = new ActiveFolder(__DIR__);
$af->getFolders(); // returns a list of folders
$af->getAbsoluteFolders(); // returns a list of folders with absolute paths
$af->getFiles(); // returns a list of files
$af->getAbsoluteFiles(); // returns a list of files with absolute paths

$asf = new ActiveSubFolder(__DIR__, '.');
$asf->getFolders();
$asf->getAbsoluteFolders();
$asf->getRelativeFolders(); // returns a list of folders with relative paths to the base folder
$asf->getFiles();
$asf->getAbsoluteFiles();
$asf->getRelativeFiles(); // returns a list of files with relative paths to the base folder
```
