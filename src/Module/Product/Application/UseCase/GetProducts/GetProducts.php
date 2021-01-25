<?php

namespace App\Module\Product\Application\UseCase\GetProducts;

use App\Module\Product\Domain\Model\ProductRepositoryInterface;
use App\Module\Product\Domain\Model\ProductsCollection;

final class GetProducts
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductsRequest $request): ProductsCollection
    {
        return $this->productRepository->getCollection($request->getProductIds());
    }
}