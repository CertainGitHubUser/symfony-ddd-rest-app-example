<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitsWithProductCollection;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitsWithProductCollectionFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitWithProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductsCollection;

final class CartUnitsWithProductCollectionFactory implements CartUnitsWithProductCollectionFactoryInterface
{
    private CartUnitWithProductFactoryInterface $cartUnitWithProductFactory;

    public function __construct(CartUnitWithProductFactoryInterface $cartUnitWithProductFactory)
    {
        $this->cartUnitWithProductFactory = $cartUnitWithProductFactory;
    }

    public function fromArgs(ProductsCollection $productsCollection, CartUnitsCollection $cartUnitsCollection): CartUnitsWithProductCollection
    {
        $ret = [];
        $cartUnits = $cartUnitsCollection->all();

        foreach ($cartUnits as $cartUnit) {
            $ret[] = $this->cartUnitWithProductFactory->fromArgs(
                $productsCollection->get($cartUnit->productId())
                , $cartUnit
            );
        }

        return new CartUnitsWithProductCollection($ret);
    }
}