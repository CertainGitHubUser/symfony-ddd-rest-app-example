<?php

namespace App\Module\Cart\Domain\Model\CartUnit\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidCartUnitIdException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 23;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid cart unit id '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}