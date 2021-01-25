<?php

namespace App\Module\Product\Application\Facade;

use App\Module\Product\Application\UseCase\AddProduct\AddProductRequest;
use App\Module\Product\Application\UseCase\AddProduct\AddUserRequest;
use App\Module\Product\Application\UseCase\DeleteProduct\DeleteProductRequest;
use App\Module\Product\Application\UseCase\GetProduct\GetProductRequest;
use App\Module\Product\Application\UseCase\GetProducts\GetProductsRequest;
use App\Module\Product\Application\UseCase\GetProductsPaginatedCollection\GetProductsPaginatedCollectionRequest;
use App\Module\Product\Application\UseCase\UpdateProduct\UpdateProductRequest;
use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductsCollection;
use App\Module\Product\Domain\Model\ProductsPaginatedCollection;
use Symfony\Component\HttpKernel\KernelInterface;

final class ProductFacade
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function instance(): self
    {
        global $kernel;

        return new self($kernel);
    }

    public function addProduct(float $price, string $title): Product
    {
        $request = new AddProductRequest($price, $title);
        $service = $this->kernel->getContainer()->get('sdrae.product.use_case.add_product');

        return $service->handle($request);
    }

    public function updateProduct(int $productId, float $price, string $title): Product
    {
        $request = new UpdateProductRequest($price, $title, $productId);
        $service = $this->kernel->getContainer()->get('sdrae.product.use_case.update_product');

        return $service->handle($request);
    }

    public function getProductsPaginatedCollection(int $limit, int $offset): ProductsPaginatedCollection
    {
        $request = new GetProductsPaginatedCollectionRequest($limit, $offset);
        $service = $this->kernel->getContainer()->get('sdrae.product.use_case.get_products_paginated_collection');

        return $service->handle($request);
    }

    public function getProductsCollection(array $productIds): ProductsCollection
    {
        $request = new GetProductsRequest($productIds);
        $service = $this->kernel->getContainer()->get('sdrae.product.use_case.get_products_collection');

        return $service->handle($request);
    }

    public function get(int $productId): Product
    {
        $request = new GetProductRequest($productId);

        return $this->kernel->getContainer()->get('sdrae.product.use_case.get_product')->handle($request);
    }

    public function deleteProduct(int $productId): void
    {
        $request = new DeleteProductRequest($productId);

        $this->kernel->getContainer()->get('sdrae.product.use_case.delete_product')->handle($request);
    }
}