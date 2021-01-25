<?php

namespace App\Module\Cart\Domain\Model\CartUnitWithProduct;

use App\Module\Common\Application\DTO\AssertContainsOnlyInstancesOfTrait;

final class CartUnitsWithProductCollection
{
    use AssertContainsOnlyInstancesOfTrait;

    /** @var CartUnitWithProduct[] */
    private array $cartUnitsWithProduct;

    public function __construct(array $cartUnitsWithProduct)
    {
        $this->assertContainsOnlyInstancesOf(CartUnitWithProduct::class, $cartUnitsWithProduct);
        $this->cartUnitsWithProduct = $cartUnitsWithProduct;
    }

    public function all(): array
    {
        return $this->cartUnitsWithProduct;
    }
}