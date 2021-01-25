<?php

namespace App\Module\Cart\Infrastructure\Factory;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\Cart\CartDtoInterface;
use App\Module\Cart\Domain\Model\Cart\CartFactoryInterface;
use App\Module\Cart\Infrastructure\Entity\CartEntity;
use App\Module\User\Domain\Model\UserId;

final class CartFactory implements CartFactoryInterface
{
    public function fromArgs(UserId $userId): Cart
    {
        $entity = new CartEntity();
        $entity->setOwnerId($userId->value());
        $entity->setTotalSum(Cart::DEFAULT_TOTAL_SUM);
        $entity->setUnitsAmount(Cart::DEFAULT_UNITS_AMOUNT);

        return $this->fromDto($entity);
    }

    public function fromDto(CartDtoInterface $dto): Cart
    {
        return new Cart($dto);
    }
}