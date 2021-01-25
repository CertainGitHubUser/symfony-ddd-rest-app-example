<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;
use App\Module\Common\Domain\ValueObject\UnsignedInt;

interface ProductRepositoryInterface
{
    public function hasProduct(ProductTitle $title): bool;

    public function getByTitle(ProductTitle $title): Product;

    public function getProductsAmount(): UnsignedInt;

    public function get(ProductId $productId): Product;

    /** @param ProductId[] $productIds*/
    public function getCollection(array $productIds): ProductsCollection;

    public function getPaginatedCollection(PaginationLimit $limit, PaginationOffset $offset): ProductsPaginatedCollection;

    public function save(Product $product): void;

    public function remove(Product $product): void;
}