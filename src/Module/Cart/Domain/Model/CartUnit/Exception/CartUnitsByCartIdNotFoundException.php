<?php

namespace App\Module\Cart\Domain\Model\CartUnit\Exception;

use Throwable;

final class CartUnitsByCartIdNotFoundException extends \Exception
{
    public const ERROR_CODE = 25;

    public function __construct($cartId = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no cart units by cart id:'{$cartId}'";

        parent::__construct($message, $code, $previous);
    }

}