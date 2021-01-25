<?php

namespace App\Module\Cart\Application\UseCase\CartUnit\DeleteCartUnit;

use App\Module\Cart\Domain\Model\Cart\CartRepositoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitRepositoryInterface;
use App\Module\Product\Application\Facade\ProductFacade;
use Doctrine\ORM\EntityManagerInterface;

final class DeleteCartUnit
{
    private CartRepositoryInterface $cartRepository;

    private CartUnitRepositoryInterface $cartUnitRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartUnitRepositoryInterface $cartUnitRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartUnitRepository = $cartUnitRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(DeleteCartUnitRequest $request): void
    {
        $this->entityManager->beginTransaction();

        $cart = $this->cartRepository->get($request->getCartId());
        ProductFacade::instance()->get($request->getProductId()->value());
        $cartUnit = $this->cartUnitRepository->getByCartIdAndProductId($request->getCartId(), $request->getProductId());

        $cart->getDto()->setTotalSum($cart->totalSum()->value() - $cartUnit->totalPrice()->value());
        $cart->getDto()->setUnitsAmount($cart->unitsAmount()->value() - 1);

        $this->cartRepository->save($cart);
        $this->cartUnitRepository->remove($cartUnit);

        $this->entityManager->commit();
    }
}