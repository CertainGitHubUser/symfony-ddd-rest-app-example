<?php

namespace App\Module\User\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class UserByNameNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 15;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no user by name '{$message}'";

        parent::__construct($message, $code, $previous);
    }

}