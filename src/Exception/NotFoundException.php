<?php

declare(strict_types=1);

namespace Mmm\Folder\Exception;

use RuntimeException;

class NotFoundException extends RuntimeException implements ExceptionInterface
{
    protected $message = 'Folder can not be found.';
}
