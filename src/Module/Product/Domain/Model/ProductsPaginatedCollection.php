<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\Model\PaginatedCollectionInterface;
use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Common\Application\DTO\AssertContainsOnlyInstancesOfTrait;

final class ProductsPaginatedCollection implements PaginatedCollectionInterface
{
    use AssertContainsOnlyInstancesOfTrait;

    public const MINIMAL_ITEMS_AMOUNT = 5;

    /** @var Product[] */
    private array $products;

    private UnsignedInt $total;

    private PaginationOffset $offset;

    private PaginationLimit $limit;

    public function __construct(
        array $products,
        UnsignedInt $total,
        PaginationOffset $offset,
        PaginationLimit $limit
    )
    {
        $this->assertContainsOnlyInstancesOf(Product::class, $products);

        $this->products = $products;
        $this->total = $total;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function all(): array
    {
        return $this->products;
    }

    public function getTotal(): UnsignedInt
    {
        return $this->total;
    }

    public function getOffset(): PaginationOffset
    {
        return $this->offset;
    }

    public function getLimit(): PaginationLimit
    {
        return $this->limit;
    }
}