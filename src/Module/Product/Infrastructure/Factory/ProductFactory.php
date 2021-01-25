<?php

namespace App\Module\Product\Infrastructure\Factory;

use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductDtoInterface;
use App\Module\Product\Domain\Model\ProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductPrice;
use App\Module\Product\Domain\Model\ProductTitle;
use App\Module\Product\Infrastructure\Entity\ProductEntity;

final class ProductFactory implements ProductFactoryInterface
{
    public function fromArgs(ProductTitle $title, ProductPrice $price): Product
    {
        $entity = new ProductEntity();
        $entity->setTitle($title->value());
        $entity->setPrice($price->value());

        return $this->fromDto($entity);
    }

    public function fromDto(ProductDtoInterface $dto): Product
    {
        return new Product($dto);
    }
}