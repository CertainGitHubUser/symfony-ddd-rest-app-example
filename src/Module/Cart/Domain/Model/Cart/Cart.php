<?php

namespace App\Module\Cart\Domain\Model\Cart;

use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\User\Domain\Model\UserId;

final class Cart implements \JsonSerializable
{
    public const MAX_UNITS_AMOUNT = 3;

    public const DEFAULT_TOTAL_SUM = 0;

    public const DEFAULT_UNITS_AMOUNT = 0;

    private CartDtoInterface $dto;

    public function __construct($dto)
    {
        $this->dto = $dto;
    }

    public function getDto(): CartDtoInterface
    {
        return $this->dto;
    }

    public function id(): CartId
    {
        return $this->getDto()->getId();
    }

    public function ownerId(): UserId
    {
        return $this->dto->getOwnerId();
    }

    public function totalSum(): UnsignedInt
    {
        return $this->dto->getTotalSum();
    }

    public function unitsAmount(): CartUnitsAmount
    {
        return $this->dto->getUnitsAmount();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'ownerId' => $this->ownerId()->value(),
            'totalSum' => $this->totalSum()->value(),
            'unitsAmount' => $this->unitsAmount()->value()
        ];
    }
}