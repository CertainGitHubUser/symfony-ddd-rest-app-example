<?php

namespace App\Module\Cart\Infrastructure\Entity;

use App\Module\Cart\Domain\Model\Cart\CartDtoInterface;
use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Cart\Domain\Model\Cart\CartUnitsAmount;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\User\Domain\Model\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("cart")
 */
class CartEntity implements CartDtoInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $ownerId;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $totalSum;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $unitsAmount;

    public function getId(): CartId
    {
        return CartId::fromString($this->id);
    }

    public function setId($id): void
    {
        $this->id = CartId::fromString($id)->value();
    }

    public function getOwnerId(): UserId
    {
        return UserId::fromString($this->ownerId);
    }

    public function setOwnerId($ownerId): void
    {
        $this->ownerId = UserId::fromString($ownerId)->value();
    }

    public function getTotalSum(): UnsignedInt
    {
        return UnsignedInt::fromString($this->totalSum);
    }

    public function setTotalSum($totalSum): void
    {
        $this->totalSum = UnsignedInt::fromString($totalSum)->value();
    }

    public function getUnitsAmount(): CartUnitsAmount
    {
        return CartUnitsAmount::fromString($this->unitsAmount);
    }

    public function setUnitsAmount($unitsAmount): void
    {
        $this->unitsAmount = CartUnitsAmount::fromString($unitsAmount)->value();
    }
}