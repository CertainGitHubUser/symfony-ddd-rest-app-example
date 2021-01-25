<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\CartDetails\CartDetails;
use App\Module\Cart\Domain\Model\CartDetails\CartDetailsFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitsWithProductCollectionFactoryInterface;
use App\Module\Product\Domain\Model\ProductsCollection;

final class CartDetailsFactory implements CartDetailsFactoryInterface
{
    private CartUnitsWithProductCollectionFactoryInterface $cartUnitsWithProductCollectionFactory;

    public function __construct(CartUnitsWithProductCollectionFactoryInterface $cartUnitsWithProductCollectionFactory)
    {
        $this->cartUnitsWithProductCollectionFactory = $cartUnitsWithProductCollectionFactory;
    }

    public function fromArgs(
        Cart $cart,
        CartUnitsCollection $cartUnitsCollection,
        ProductsCollection $productsCollection
    ): CartDetails
    {
        return new CartDetails(
            $cart,
            $this->cartUnitsWithProductCollectionFactory->fromArgs($productsCollection, $cartUnitsCollection)
        );
    }
}