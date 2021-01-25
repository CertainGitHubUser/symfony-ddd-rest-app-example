<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\Constraints\MaxDoubleDecimalFloat;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use App\Module\Product\Domain\Model\Exception\InvalidProductPriceException;

final class ProductPrice extends AbstractValueObject
{
    public const PRODUCT_PRICE_NUMBER_FORMAT = '/^\d+\.\d{1,2}$|^\d+$/';

    public const DECIMAL_PLACES_AMOUNT = 2;

    protected function initialConversion($price): float
    {
        return (float)$price;
    }

    protected function validate($price): void
    {
        if (!preg_match(self::PRODUCT_PRICE_NUMBER_FORMAT, $price) || $price > MaxDoubleDecimalFloat::VALUE) {
            throw new InvalidProductPriceException($price);
        }
    }

    public function valueInFormat(): string
    {
        return number_format(parent::value(), self::DECIMAL_PLACES_AMOUNT, '.', '');
    }
}