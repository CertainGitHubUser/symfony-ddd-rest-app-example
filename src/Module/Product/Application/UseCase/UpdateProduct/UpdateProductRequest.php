<?php

namespace App\Module\Product\Application\UseCase\UpdateProduct;

use App\Module\Product\Domain\Model\ProductId;
use App\Module\Product\Domain\Model\ProductPrice;
use App\Module\Product\Domain\Model\ProductTitle;

final class UpdateProductRequest
{
    private ProductId $productId;

    private ProductPrice $price;

    private ProductTitle $title;

    public function __construct(float $price, string $title, int $productId)
    {
        $this->price = new ProductPrice($price);
        $this->title = new ProductTitle($title);
        $this->productId = new ProductId($productId);
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    public function getTitle(): ProductTitle
    {
        return $this->title;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }
}