<?php

namespace App\Module\Cart\Application\UseCase\CartUnit\AddCartUnit;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Product\Domain\Model\ProductId;

final class AddCartUnitRequest
{
    private CartId $cartId;

    private ProductId $productId;

    public function __construct(int $cartId, int $productId)
    {
        $this->cartId = new CartId($cartId);
        $this->productId = new ProductId($productId);
    }

    public function getCartId(): CartId
    {
        return $this->cartId;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }
}