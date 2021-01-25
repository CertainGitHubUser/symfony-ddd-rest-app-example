<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\Product\Domain\Model\Exception\InvalidProductTitleException;

final class ProductTitle extends AbstractValueObject
{
    public const MAX_LENGTH = 100;

    protected function initialConversion($title): string
    {
        return (string)$title;
    }

    protected function validate($title): void
    {
        if (empty($title) || mb_strlen($title) > self::MAX_LENGTH) {
            throw new InvalidProductTitleException($title);
        }
    }
}