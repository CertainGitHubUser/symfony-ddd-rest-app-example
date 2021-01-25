<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Product\Domain\Model\ProductId;

interface CartUnitRepositoryInterface
{
    public function getCartUnits(CartId $cartId): CartUnitsCollection;

    public function cartsHasProduct(ProductId $productId): bool;

    public function cartHasUnit(CartId $cartId, ProductId $productId): bool;

    public function getByCartIdAndProductId(CartId $cartId, ProductId $productId): CartUnit;

    public function get(CartUnitId $cartUnitId): CartUnit;

    public function save(CartUnit $cartUnit): void;

    public function remove(CartUnit $cartUnit): void;
}