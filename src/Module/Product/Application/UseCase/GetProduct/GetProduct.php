<?php

namespace App\Module\Product\Application\UseCase\GetProduct;

use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductRepositoryInterface;

final class GetProduct
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductRequest $request): Product
    {
        return $this->productRepository->get($request->getProductId());
    }
}