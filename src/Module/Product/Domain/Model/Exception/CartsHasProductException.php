<?php

namespace App\Module\Product\Domain\Model\Exception;

use \Throwable;

final class CartsHasProductException extends \Exception
{
    public const ERROR_CODE = 27;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "product by id '{$message}' can not be deleted because it's in the carts.";

        parent::__construct($message, $code, $previous);
    }

}