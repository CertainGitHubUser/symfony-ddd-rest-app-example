<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Common\Application\DTO\AssertContainsOnlyInstancesOfTrait;
use App\Module\Product\Domain\Model\ProductId;

final class CartUnitsCollection
{
    use AssertContainsOnlyInstancesOfTrait;

    /** @var CartUnit[] */
    private array $cartUnits;

    /** @var array [productId => cartUnit] */
    private array $productIdMap;

    public function __construct(array $cartUnits)
    {
        $this->assertContainsOnlyInstancesOf(CartUnit::class, $cartUnits);
        $this->cartUnits = $cartUnits;
        $this->makeProductIdMap();
    }

    private function makeProductIdMap(): void
    {
        $this->productIdMap = [];

        foreach ($this->cartUnits as $cartUnit) {
            $this->productIdMap[$cartUnit->productId()->value()] = $cartUnit;
        }
    }

    public function getByProductId(ProductId $productId): ?CartUnit
    {
        return $this->productIdMap[$productId->value()] ?? null;
    }

    public function hasUnit(ProductId $productId): bool
    {
        return $this->getByProductId($productId) !== null;
    }

    public function all(): array
    {
        return $this->cartUnits;
    }

    public function count(): int
    {
        return count($this->cartUnits);
    }

    public function empty(): bool
    {
        return empty($this->cartUnits);
    }

    public function getProductIdsAsIntArray(): array
    {
        return array_keys($this->productIdMap);
    }

    public function getProductIds(): array
    {
        $ids = $this->getProductIdsAsIntArray();
        $res = [];

        foreach ($ids as $id) {
            $res[] = new ProductId($id);
        }

        return $res;
    }
}