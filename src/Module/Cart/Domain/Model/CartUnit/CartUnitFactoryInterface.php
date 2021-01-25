<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Product\Domain\Model\Product;

interface CartUnitFactoryInterface
{
    public function fromArgs(CartId $cartId, Product $product): CartUnit;

    public function fromDto(CartUnitDtoInterface $dto): CartUnit;
}