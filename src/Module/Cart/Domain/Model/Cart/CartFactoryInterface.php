<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\User\Domain\Model\UserId;

interface CartFactoryInterface
{
    public function fromArgs(UserId $userId): Cart;

    public function fromDto(CartDtoInterface $dto): Cart;
}