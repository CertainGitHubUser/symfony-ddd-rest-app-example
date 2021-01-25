<?php

namespace App\Module\Product\Application\UseCase\AddProduct;

use App\Module\Product\Domain\Model\Exception\ProductAlreadyExistException;
use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductRepositoryInterface;

final class AddProduct
{
    private ProductFactoryInterface $productFactory;

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductFactoryInterface $productFactory, ProductRepositoryInterface $productRepository)
    {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function handle(AddProductRequest $request): Product
    {
        $this->assertIsValid($request);

        $product = $this->productFactory->fromArgs($request->getTitle(), $request->getPrice());
        $this->productRepository->save($product);

        return $product;
    }

    private function assertIsValid(AddProductRequest $request): void
    {
        if ($this->productRepository->hasProduct($request->getTitle())) {
            throw new ProductAlreadyExistException($request->getTitle());
        }
    }
}