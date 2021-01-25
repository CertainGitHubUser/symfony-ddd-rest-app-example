<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class ProductAlreadyExistException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 6;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct("Product with title {$message} already exist.", $code, $previous);
    }
}