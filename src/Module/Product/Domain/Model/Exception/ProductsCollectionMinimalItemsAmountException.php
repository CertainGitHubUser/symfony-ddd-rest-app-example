<?php

namespace App\Module\Product\Domain\Model\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use App\Module\Product\Domain\Model\ProductsPaginatedCollection;
use Throwable;

final class ProductsCollectionMinimalItemsAmountException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 10;

    public function __construct($amount = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        parent::__construct($this->makeMessage($amount), $code, $previous);
    }

    private function makeMessage($amount): string
    {
        return 'Invalid products amount ' .
            $amount . '. There should be at least ' .
            ProductsPaginatedCollection::MINIMAL_ITEMS_AMOUNT . " items.";
    }
}