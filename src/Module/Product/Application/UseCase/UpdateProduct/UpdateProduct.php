<?php

namespace App\Module\Product\Application\UseCase\UpdateProduct;

use App\Module\Product\Domain\Model\Exception\ProductAlreadyExistException;
use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductRepositoryInterface;

final class UpdateProduct
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(UpdateProductRequest $request): Product
    {
        $product = $this->productRepository->get($request->getProductId());

        $this->assertIsValid($request, $product);

        $product->getDto()->setPrice($request->getPrice()->value());
        $product->getDto()->setTitle($request->getTitle()->value());
        $this->productRepository->save($product);

        return $product;
    }

    public function assertIsValid(UpdateProductRequest $request, Product $product): void
    {
        if (!$request->getTitle()->equals($product->title()) && $this->productRepository->hasProduct($request->getTitle())) {
            throw new ProductAlreadyExistException($request->getTitle());
        }
    }
}