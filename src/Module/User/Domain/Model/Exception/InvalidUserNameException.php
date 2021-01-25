<?php

namespace App\Module\User\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidUserNameException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 11;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct("invalid user name {$message}", $code, $previous);
    }
}