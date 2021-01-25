<?php

namespace App\Module\Cart\Application\UseCase\Cart\GetCartDetails;

use App\Module\Cart\Domain\Model\Cart\CartId;

final class GetCartDetailsRequest
{
    private CartId $cartId;

    public function __construct(int $cartId)
    {
        $this->cartId = new CartId($cartId);
    }

    public function getCartId(): CartId
    {
        return $this->cartId;
    }
}