<?php

namespace App\Module\User\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class UserNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 14;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no user by id '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}