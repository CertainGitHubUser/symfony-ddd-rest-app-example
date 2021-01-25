<?php

namespace App\Module\Product\Application\UseCase\GetProductsPaginatedCollection;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;

final class GetProductsPaginatedCollectionRequest
{
    private PaginationLimit $limit;

    private PaginationOffset $offset;

    public function __construct(int $limit, int $offset)
    {
        $this->limit = new PaginationLimit($limit);
        $this->offset = new PaginationOffset($offset);
    }

    public function getLimit(): PaginationLimit
    {
        return $this->limit;
    }

    public function getOffset(): PaginationOffset
    {
        return $this->offset;
    }
}