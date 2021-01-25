<?php

namespace App\Module\Cart\Application\UseCase\CartUnit\CartsHasProduct;

use App\Module\Cart\Domain\Model\CartUnit\CartUnitRepositoryInterface;

final class CartsHasProduct
{
    private CartUnitRepositoryInterface $cartUnitRepository;

    public function __construct(CartUnitRepositoryInterface $cartUnitRepository)
    {
        $this->cartUnitRepository = $cartUnitRepository;
    }

    public function handle(CartsHasProductRequest $request): bool
    {
        return $this->cartUnitRepository->cartsHasProduct($request->getProductId());
    }
}