<?php

namespace App\Module\Cart\Domain\Model\Cart\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class CartNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 17;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no cart by id '{$message}'";

        parent::__construct($message, $code, $previous);
    }

}