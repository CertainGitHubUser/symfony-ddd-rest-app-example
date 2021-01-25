<?php

namespace App\Module\User\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class UserAlreadyExistException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 13;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct("User with name {$message} already exist.", $code, $previous);
    }
}