<?php

namespace App\Module\Product\Application\UseCase\GetProducts;

use App\Module\Product\Domain\Model\ProductId;

final class GetProductsRequest
{
    /** @var ProductId[] */
    private array $productIds;

    public function __construct(array $productIds)
    {
        $this->productIds = [];
        foreach ($productIds as $productId) {
            $this->productIds[] = new ProductId($productId);
        }
    }

    public function getProductIds(): array
    {
        return $this->productIds;
    }
}