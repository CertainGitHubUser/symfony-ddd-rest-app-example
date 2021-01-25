<?php

namespace App\Module\Product\Application\UseCase\GetProduct;

use App\Module\Product\Domain\Model\ProductId;

final class GetProductRequest
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