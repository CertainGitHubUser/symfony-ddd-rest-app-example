<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\Product\Domain\Model\Exception\InvalidProductIdException;

final class ProductId extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidProductIdException($value);
        }
    }

}