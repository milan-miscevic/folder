# folder

Folder (scanner) abstraction

## Usage

```php
use Mmm\Folder\ActiveFolder;
use Mmm\Folder\ActiveSubFolder;

$af = new ActiveFolder(__DIR__);
$af->getFolders(); // returns list of folders
$af->getAbsoluteFolders(); // returns list of folders with absolute paths
$af->getFiles(); // returns list of files
$af->getAbsoluteFiles(); // returns list of files with absolute paths

$asf = new ActiveSubFolder(__DIR__, '.');
$asf->getFolders();
$asf->getAbsoluteFolders();
$asf->getRelativeFolders(); // returns list of folders with relative paths to base folder
$asf->getFiles();
$asf->getAbsoluteFiles();
$asf->getRelativeFiles(); // returns list of files with relative paths to base folder
```
