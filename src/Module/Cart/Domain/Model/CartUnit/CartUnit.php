<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Product\Domain\Model\ProductId;

final class CartUnit implements \JsonSerializable
{
    public const MAX_ITEMS_AMOUNT = 10;

    private CartUnitDtoInterface $dto;

    public function __construct($dto)
    {
        $this->dto = $dto;
    }

    public function getDto(): CartUnitDtoInterface
    {
        return $this->dto;
    }

    public function id(): CartUnitId
    {
        return $this->dto->getId();
    }

    public function cartId(): CartId
    {
        return $this->dto->getCartId();
    }

    public function productId(): ProductId
    {
        return $this->dto->getProductId();
    }

    public function itemsAmount(): CartUnitItemsAmount
    {
        return $this->dto->getItemsAmount();
    }

    public function totalPrice(): UnsignedInt
    {
        return $this->dto->getTotalPrice();
    }

    public function itemPrice(): UnsignedInt
    {
        return $this->dto->getItemPrice();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'cartId' => $this->cartId()->value(),
            'productId' => $this->productId()->value(),
            'itemsAmount' => $this->itemsAmount()->value(),
            'totalPrice' => $this->totalPrice()->value(),
            'itemPrice' => $this->itemPrice()->value()
        ];
    }
}