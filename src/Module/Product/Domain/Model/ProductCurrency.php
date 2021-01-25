<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\Product\Domain\Model\Exception\InvalidProductCurrencyException;

final class ProductCurrency extends AbstractValueObject
{
    public const CURRENCY_USD = 'USD';

    public const DEFAULT_CURRENCY = self::CURRENCY_USD;

    public const AVIALABLE_CURRENCIES = [
        self::CURRENCY_USD
    ];

    protected function initialConversion($currency): string
    {
        return (string)$currency;
    }

    protected function validate($currency): void
    {
        if (!in_array($currency, self::AVIALABLE_CURRENCIES, true)) {
            throw new InvalidProductCurrencyException($currency);
        }
    }
}