<?php

namespace App\Module\Cart\Domain\Model\Cart\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;

final class UserHasCartException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 19;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct("User with id: {$message} already has cart.", $code, $previous);
    }
}