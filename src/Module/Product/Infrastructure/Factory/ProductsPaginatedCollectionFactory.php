<?php

namespace App\Module\Product\Infrastructure\Factory;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Product\Domain\Model\ProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductsPaginatedCollection;
use App\Module\Product\Domain\Model\ProductsPaginatedCollectionFactoryInterface;

final class ProductsPaginatedCollectionFactory implements ProductsPaginatedCollectionFactoryInterface
{
    private ProductFactoryInterface $productFactory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function fromArgs(
        array $productEntityList,
        UnsignedInt $total,
        PaginationOffset $offset,
        PaginationLimit $limit
    ): ProductsPaginatedCollection
    {
        $products = [];

        foreach ($productEntityList as $productEntity) {
            $products[] = $this->productFactory->fromDto($productEntity);
        }

        return new ProductsPaginatedCollection($products, $total, $offset, $limit);
    }
}