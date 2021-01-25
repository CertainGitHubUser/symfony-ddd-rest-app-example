<?php

namespace App\Module\Cart\Domain\Model\CartUnitWithProduct;

use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Product\Domain\Model\ProductsCollection;

interface CartUnitsWithProductCollectionFactoryInterface
{
    public function fromArgs(
        ProductsCollection $productsCollection,
        CartUnitsCollection $cartUnitsCollection
    ): CartUnitsWithProductCollection;
}