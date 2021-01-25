<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\Cart\Domain\Model\Cart\Exception\InvalidCartIdException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class CartId extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidCartIdException($value);
        }
    }
}