<?php

namespace App\Module\Cart\Domain\Model\Cart\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidCartIdException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 16;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid cart id '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}