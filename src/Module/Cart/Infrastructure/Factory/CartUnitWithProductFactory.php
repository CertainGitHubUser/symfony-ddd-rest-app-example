<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitWithProduct;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitWithProductFactoryInterface;
use App\Module\Product\Domain\Model\Product;

final class CartUnitWithProductFactory implements CartUnitWithProductFactoryInterface
{
    public function fromArgs(Product $product, CartUnit $cartUnit): CartUnitWithProduct
    {
        return new CartUnitWithProduct($product, $cartUnit);
    }
}