<?php

namespace App\Module\Product\Domain\Model;

interface ProductDtoInterface
{
    public function getId(): ProductId;

    public function setId(int $id): void;

    public function getTitle(): ProductTitle;

    public function setTitle(string $title): void;

    public function getPrice(): ProductPrice;

    public function setPrice(float $price): void;

    public function getCurrency(): ProductCurrency;
}