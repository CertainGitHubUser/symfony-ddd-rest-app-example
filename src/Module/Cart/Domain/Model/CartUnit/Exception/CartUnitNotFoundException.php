<?php

namespace App\Module\Cart\Domain\Model\CartUnit\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class CartUnitNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 26;

    public function __construct($cartUnitId = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no cart unit by cart unit id:'{$cartUnitId}'";

        parent::__construct($message, $code, $previous);
    }

}