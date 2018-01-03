<?php

namespace Mmm\Folder\Exception;

use RuntimeException;

class OutOfBaseException extends RuntimeException implements ExceptionInterface
{
    protected $message = 'Subfolder is out of base folder.';
}
