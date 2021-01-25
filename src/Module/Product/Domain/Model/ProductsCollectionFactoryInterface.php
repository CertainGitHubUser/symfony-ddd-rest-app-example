<?php

namespace App\Module\Product\Domain\Model;

interface ProductsCollectionFactoryInterface
{
    public function fromDtoList(array $productEntityList): ProductsCollection;
}