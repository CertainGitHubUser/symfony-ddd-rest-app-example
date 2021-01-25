<?php

namespace App\Module\Product\Application\UseCase\GetProductsPaginatedCollection;

use App\Module\Product\Domain\Model\ProductRepositoryInterface;
use App\Module\Product\Domain\Model\ProductsPaginatedCollection;

final class GetProductsPaginatedCollection
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductsPaginatedCollectionRequest $request): ProductsPaginatedCollection
    {
        return $this->productRepository->getPaginatedCollection($request->getLimit(), $request->getOffset());
    }
}