<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\CartUnit\Exception\InvalidCartUnitIdException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class CartUnitId extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidCartUnitIdException($value);
        }
    }
}