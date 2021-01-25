<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitDtoInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitFactoryInterface;
use App\Module\Cart\Infrastructure\Entity\CartUnitEntity;
use App\Module\Product\Domain\Model\Product;

final class CartUnitFactory implements CartUnitFactoryInterface
{
    public function fromArgs(CartId $cartId, Product $product): CartUnit
    {
        $entity = new CartUnitEntity();
        $entity->setCartId($cartId->value());
        $entity->setItemsAmount(1);
        $entity->setProductId($product->id()->value());
        $entity->setTotalPrice($product->price()->value());
        $entity->setItemPrice($product->price()->value());

        return $this->fromDto($entity);
    }

    public function fromDto(CartUnitDtoInterface $dto): CartUnit
    {
        return new CartUnit($dto);
    }
}