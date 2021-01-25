<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\CartUnit\Exception\InvalidCartUnitItemsAmountException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class CartUnitItemsAmount extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > CartUnit::MAX_ITEMS_AMOUNT) {
            throw new InvalidCartUnitItemsAmountException($value);
        }
    }
}