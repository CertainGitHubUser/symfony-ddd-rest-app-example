<?php

namespace App\Module\User\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\User\Domain\Model\Exception\InvalidUserIdException;

final class UserId extends AbstractValueObject
{
    protected function initialConversion($value): int
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidUserIdException($value);
        }
    }
}