<?php

namespace App\Module\Cart\Domain\Model\CartDetails;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\CartUnitWithProduct\CartUnitsWithProductCollection;

final class CartDetails implements \JsonSerializable
{
    private Cart $cart;

    private CartUnitsWithProductCollection $cartUnitsWithProductCollection;

    public function __construct(Cart $cart, CartUnitsWithProductCollection $cartUnitsWithProductCollection)
    {
        $this->cart = $cart;
        $this->cartUnitsWithProductCollection = $cartUnitsWithProductCollection;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->cart->id()->value(),
            'ownerId' => $this->cart->ownerId()->value(),
            'totalSum' => $this->cart->totalSum()->value(),
            'unitsAmount' => $this->cart->unitsAmount()->value(),
            'units' => $this->cartUnitsWithProductCollection->all()
        ];
    }
}