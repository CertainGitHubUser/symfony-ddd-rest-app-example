<?php

namespace App\Module\Cart\Domain\Model\CartUnit\Exception;

use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidCartUnitItemsAmountException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 24;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid cart unit items amount '{$message}'. Cart unit can have up to " . CartUnit::MAX_ITEMS_AMOUNT .
            " items.";

        parent::__construct($message, $code, $previous);
    }
}