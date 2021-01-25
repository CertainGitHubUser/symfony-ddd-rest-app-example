<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidProductTitleException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 2;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct("invalid product title {$message}", $code, $previous);
    }
}