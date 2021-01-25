<?php

namespace App\Module\Cart\Domain\Model\CartDetails;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Product\Domain\Model\ProductsCollection;

interface CartDetailsFactoryInterface
{
    public function fromArgs(
        Cart $cart,
        CartUnitsCollection $cartUnitsCollection,
        ProductsCollection $productsCollection
    ): CartDetails;
}