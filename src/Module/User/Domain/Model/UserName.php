<?php

namespace App\Module\User\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\User\Domain\Model\Exception\InvalidUserNameException;

final class UserName extends AbstractValueObject
{
    public const MAX_LENGTH = 100;

    protected function initialConversion($title): string
    {
        return (string)$title;
    }

    protected function validate($title): void
    {
        if (empty($title) || mb_strlen($title) > self::MAX_LENGTH) {
            throw new InvalidUserNameException($title);
        }
    }
}