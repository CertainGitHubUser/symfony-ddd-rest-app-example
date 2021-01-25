<?php

namespace App\Module\User\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidUserIdException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 12;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid user id '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}