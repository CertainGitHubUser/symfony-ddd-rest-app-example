<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\User\Domain\Model\UserId;

interface CartRepositoryInterface
{
    public function get(CartId $cartId): Cart;

    public function getByOwner(UserId $userId): Cart;

    public function userHasCart(UserId $userId): bool;

    public function save(Cart $cart): void;
}