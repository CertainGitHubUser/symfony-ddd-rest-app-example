<?php

namespace App\Module\Cart\Infrastructure\Entity;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitDtoInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitId;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitItemsAmount;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Product\Domain\Model\ProductId;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Entity
 * @ORM\Table("cart_unit", indexes={
 *     @Index(name="cart_idx", columns={"cart_id"})
 * })
 */
class CartUnitEntity implements CartUnitDtoInterface
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
    private int $cartId;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $productId;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $itemsAmount;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $totalPrice;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $itemPrice;

    public function getId(): CartUnitId
    {
        return CartUnitId::fromString($this->id);
    }

    public function setId($id): void
    {
        $this->id = CartUnitId::fromString($id)->value();
    }

    public function getCartId(): CartId
    {
        return CartId::fromString($this->cartId);
    }

    public function setCartId($cartId): void
    {
        $this->cartId = CartId::fromString($cartId)->value();
    }

    public function getProductId(): ProductId
    {
        return ProductId::fromString($this->productId);
    }

    public function setProductId($productId): void
    {
        $this->productId = ProductId::fromString($productId)->value();
    }

    public function getItemsAmount(): CartUnitItemsAmount
    {
        return CartUnitItemsAmount::fromString($this->itemsAmount);
    }

    public function setItemsAmount($itemsAmount): void
    {
        $this->itemsAmount = CartUnitItemsAmount::fromString($itemsAmount)->value();
    }

    public function getTotalPrice(): UnsignedInt
    {
        return UnsignedInt::fromString($this->totalPrice);
    }

    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = UnsignedInt::fromString($totalPrice)->value();
    }

    public function getItemPrice(): UnsignedInt
    {
        return UnsignedInt::fromString($this->itemPrice);
    }

    public function setItemPrice($itemPrice): void
    {
        $this->itemPrice = UnsignedInt::fromString($itemPrice)->value();
    }
}