<?php

namespace App\Module\Product\Domain\Model;

final class Product implements \JsonSerializable
{
    private ProductDtoInterface $dto;

    public function __construct($dto)
    {
        $this->dto = $dto;
    }

    public function getDto(): ProductDtoInterface
    {
        return $this->dto;
    }

    public function id(): ProductId
    {
        return $this->getDto()->getId();
    }

    public function title(): ProductTitle
    {
        return $this->getDto()->getTitle();
    }

    public function price(): ProductPrice
    {
        return $this->getDto()->getPrice();
    }

    public function currency(): ProductCurrency
    {
        return $this->getDto()->getCurrency();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'title' => $this->title()->value(),
            'price' => $this->price()->valueInFormat(),
            'currency' => $this->currency()->value()
        ];
    }
}