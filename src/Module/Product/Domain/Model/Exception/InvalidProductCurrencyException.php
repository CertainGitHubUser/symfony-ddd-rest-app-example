<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidProductCurrencyException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 4;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid product currency '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}