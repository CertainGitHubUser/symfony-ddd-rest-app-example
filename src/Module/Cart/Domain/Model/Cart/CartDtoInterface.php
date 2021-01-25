<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\User\Domain\Model\UserId;

interface CartDtoInterface
{
    public function getId(): CartId;

    public function setId($id): void;

    public function getOwnerId(): UserId;

    public function setOwnerId($ownerId): void;

    public function getTotalSum(): UnsignedInt;

    public function setTotalSum($totalSum): void;

    public function getUnitsAmount(): CartUnitsAmount;

    public function setUnitsAmount($unitsAmount): void;
}