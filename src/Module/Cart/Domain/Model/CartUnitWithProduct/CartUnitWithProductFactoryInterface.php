<?php

namespace App\Module\Cart\Domain\Model\CartUnitWithProduct;

use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Product\Domain\Model\Product;

interface CartUnitWithProductFactoryInterface
{
    public function fromArgs(Product $product, CartUnit $cartUnit): CartUnitWithProduct;
}