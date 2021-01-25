<?php

namespace App\Module\Cart\Domain\Model\CartUnitWithProduct;

use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Product\Domain\Model\Product;

final class CartUnitWithProduct implements \JsonSerializable
{
    private Product $product;

    private CartUnit $cartUnit;

    public function __construct(Product $product, CartUnit $cartUnit)
    {
        $this->product = $product;
        $this->cartUnit = $cartUnit;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function cartUnit(): CartUnit
    {
        return $this->cartUnit;
    }

    public function jsonSerialize(): array
    {
        return [
            'cartUnitId' => $this->cartUnit()->id()->value(),
            'productId' => $this->cartUnit()->productId()->value(),
            'title' => $this->product()->title()->value(),
            'totalPrice' => $this->cartUnit()->totalPrice()->value(),
            'itemsAmount' => $this->cartUnit()->itemsAmount()->value(),
            'itemPrice' => $this->cartUnit()->totalPrice()->value()
        ];
    }
}