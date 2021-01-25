<?php

namespace App\Module\Cart\Domain\Model\Cart\Exception;

use Throwable;

final class CartByUserNotFoundException extends \Exception
{
    public const ERROR_CODE = 20;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no cart by user id:'{$message}'";

        parent::__construct($message, $code, $previous);
    }
}