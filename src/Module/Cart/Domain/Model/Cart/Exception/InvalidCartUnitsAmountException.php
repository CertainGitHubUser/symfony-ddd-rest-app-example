<?php

namespace App\Module\Cart\Domain\Model\Cart\Exception;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidCartUnitsAmountException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 18;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid cart units amount '{$message}'. Cart can have up to " . Cart::MAX_UNITS_AMOUNT .
            " units.";

        parent::__construct($message, $code, $previous);
    }
}