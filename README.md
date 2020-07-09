# folder

[![PDS Skeleton](https://img.shields.io/badge/pds-skeleton-blue.svg?style=flat-square)](https://github.com/php-pds/skeleton)
[![Build Status](https://travis-ci.org/milan-miscevic/folder.svg?branch=master)](https://travis-ci.org/milan-miscevic/folder)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=milan-miscevic_folder&metric=alert_status)](https://sonarcloud.io/dashboard?id=milan-miscevic_folder)
[![Software License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

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
