<?php

namespace App\Module\Product\Infrastructure\Factory;

use App\Module\Product\Domain\Model\ProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductsCollection;
use App\Module\Product\Domain\Model\ProductsCollectionFactoryInterface;

final class ProductsCollectionFactory implements ProductsCollectionFactoryInterface
{
    private ProductFactoryInterface $productFactory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function fromDtoList(array $productEntityList): ProductsCollection
    {
        $ret = [];

        foreach ($productEntityList as $product) {
            $ret[] = $this->productFactory->fromDto($product);
        }

        return new ProductsCollection($ret);
    }
}