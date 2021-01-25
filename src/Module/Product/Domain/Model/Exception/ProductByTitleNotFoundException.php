<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\NotFoundException;
use Throwable;

final class ProductByTitleNotFoundException extends NotFoundException
{
    public const ERROR_CODE = 5;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "no product by title '{$message}'";

        parent::__construct($message, $code, $previous);
    }

}