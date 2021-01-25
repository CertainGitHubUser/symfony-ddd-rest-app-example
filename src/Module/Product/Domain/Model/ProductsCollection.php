<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Application\DTO\AssertContainsOnlyInstancesOfTrait;

final class ProductsCollection
{
    use AssertContainsOnlyInstancesOfTrait;
    /** @var Product[] */
    private array $products;

    /** @var array [productId => product] */
    private array $productIdMap;

    public function __construct(array $products)
    {
        $this->assertContainsOnlyInstancesOf(Product::class, $products);
        $this->products = $products;
        $this->makeProductIdMap();
    }

    private function makeProductIdMap(): void
    {
        $this->productIdMap = [];

        foreach ($this->products as $product) {
            $this->productIdMap[$product->id()->value()] = $product;
        }
    }

    public function get(ProductId $productId): ?Product
    {
        return $this->productIdMap[$productId->value()];
    }
}