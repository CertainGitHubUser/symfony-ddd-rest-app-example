<?php

namespace App\Module\Cart\Application\UseCase\CartUnit\CartsHasProduct;

use App\Module\Product\Domain\Model\ProductId;

final class CartsHasProductRequest
{
    private ProductId $productId;

    public function __construct(int $productId)
    {
        $this->productId = new ProductId($productId);
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }
}