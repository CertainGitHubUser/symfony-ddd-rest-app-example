<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\Cart\Domain\Model\Cart\Exception\InvalidCartUnitsAmountException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class CartUnitsAmount extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > Cart::MAX_UNITS_AMOUNT) {
            throw new InvalidCartUnitsAmountException($value);
        }
    }
}