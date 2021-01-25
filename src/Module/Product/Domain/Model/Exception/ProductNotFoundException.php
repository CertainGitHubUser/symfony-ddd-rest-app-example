<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class ProductNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 7;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no product by id '{$message}'";

        parent::__construct($message, $code, $previous);
    }

}