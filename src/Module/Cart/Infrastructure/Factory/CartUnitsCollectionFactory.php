<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\CartUnit\CartUnitFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollectionFactoryInterface;

final class CartUnitsCollectionFactory implements CartUnitsCollectionFactoryInterface
{
    private CartUnitFactoryInterface $cartUnitFactory;

    public function __construct(CartUnitFactoryInterface $cartUnitFactory)
    {
        $this->cartUnitFactory = $cartUnitFactory;
    }

    public function fromDtoList(array $cartUnitEntityList): CartUnitsCollection
    {
        $ret = [];

        foreach ($cartUnitEntityList as $cartUnit) {
            $ret[] = $this->cartUnitFactory->fromDto($cartUnit);
        }

        return new CartUnitsCollection($ret);
    }
}