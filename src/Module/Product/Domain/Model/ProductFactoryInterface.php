<?php

namespace App\Module\Product\Domain\Model;

interface ProductFactoryInterface
{
    public function fromArgs(ProductTitle $title, ProductPrice $price): Product;

    public function fromDto(ProductDtoInterface $dto): Product;
 }