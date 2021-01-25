<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Product\Domain\Model\ProductId;

interface CartUnitDtoInterface
{
    public function getId(): CartUnitId;

    public function setId($id): void;

    public function getCartId(): CartId;

    public function setCartId($cartId): void;

    public function getProductId(): ProductId;

    public function setProductId($productId): void;

    public function getItemsAmount(): CartUnitItemsAmount;

    public function setItemsAmount($itemsAmount): void;

    public function getTotalPrice(): UnsignedInt;

    public function setTotalPrice($totalPrice): void;

    public function getItemPrice(): UnsignedInt;

    public function setItemPrice($totalPrice): void;
}