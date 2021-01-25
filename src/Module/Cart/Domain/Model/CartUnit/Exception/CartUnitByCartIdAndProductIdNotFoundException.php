<?php

namespace App\Module\Cart\Domain\Model\CartUnit\Exception;

use Throwable;

final class CartUnitByCartIdAndProductIdNotFoundException extends \Exception
{
    public const ERROR_CODE = 21;

    public function __construct($cartId = "", $productId = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no cart unit by cart id:'{$cartId}' and product id:'{$productId}'";

        parent::__construct($message, $code, $previous);
    }

}