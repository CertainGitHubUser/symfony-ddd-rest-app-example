<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidProductPriceException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 3;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid product price '{$message}'. It should have two decimal places.";

        parent::__construct($message, $code, $previous);
    }
}