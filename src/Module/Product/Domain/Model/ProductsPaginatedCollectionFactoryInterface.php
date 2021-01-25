<?php

namespace App\Module\Product\Domain\Model;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;
use App\Module\Common\Domain\ValueObject\UnsignedInt;

interface ProductsPaginatedCollectionFactoryInterface
{
    public function fromArgs(
        array $productEntityList,
        UnsignedInt $total,
        PaginationOffset $offset,
        PaginationLimit $limit
    ): ProductsPaginatedCollection;
}