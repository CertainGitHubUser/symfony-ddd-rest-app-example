<?php

namespace App\Module\Product\Application\UseCase\AddProduct;

use App\Module\Product\Domain\Model\ProductPrice;
use App\Module\Product\Domain\Model\ProductTitle;

final class AddProductRequest
{
    private ProductPrice $price;

    private ProductTitle $title;

    public function __construct(float $price, string $title)
    {
        $this->price = new ProductPrice($price);
        $this->title = new ProductTitle($title);
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    public function getTitle(): ProductTitle
    {
        return $this->title;
    }
}