<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidProductIdException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 1;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid product id '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}