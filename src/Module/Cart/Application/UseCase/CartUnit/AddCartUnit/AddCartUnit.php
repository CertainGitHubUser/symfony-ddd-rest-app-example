<?php

namespace App\Module\Cart\Application\UseCase\CartUnit\AddCartUnit;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\Cart\CartRepositoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitRepositoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Product\Application\Facade\ProductFacade;
use App\Module\Product\Domain\Model\Product;
use Doctrine\ORM\EntityManagerInterface;

final class AddCartUnit
{
    private CartRepositoryInterface $cartRepository;

    private CartUnitRepositoryInterface $cartUnitRepository;

    private CartUnitFactoryInterface $cartUnitFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartUnitRepositoryInterface $cartUnitRepository,
        CartUnitFactoryInterface $cartUnitFactory,
        EntityManagerInterface $entityManager
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartUnitRepository = $cartUnitRepository;
        $this->cartUnitFactory = $cartUnitFactory;
        $this->entityManager = $entityManager;
    }

    public function handle(AddCartUnitRequest $request): CartUnit
    {
        $this->entityManager->beginTransaction();

        $cart = $this->cartRepository->get($request->getCartId());
        $product = ProductFacade::instance()->get($request->getProductId()->value());
        $cartUnits = $this->cartUnitRepository->getCartUnits($cart->id());

        if ($cartUnits->hasUnit($product->id())) {
            $cartUnit = $this->addProductToCartUnit($cartUnits, $cart, $product);
        } else {
            $cartUnit = $this->createCartUnit($cart, $product);
        }

        $this->cartUnitRepository->save($cartUnit);
        $this->cartRepository->save($cart);

        $this->entityManager->commit();

        return $cartUnit;
    }

    private function addProductToCartUnit(CartUnitsCollection $cartUnits, Cart $cart, Product $product): CartUnit
    {
        $cartUnit = $cartUnits->getByProductId($product->id());
        $cartUnit->getDto()->setItemsAmount($cartUnit->itemsAmount()->value() + 1);
        $cartUnit->getDto()->setTotalPrice(
            $cartUnit->totalPrice()->value() + $cartUnit->itemPrice()->value()
        );
        $cart->getDto()->setTotalSum($cart->totalSum()->value() + $cartUnit->itemPrice()->value());

        return $cartUnit;
    }

    private function createCartUnit(Cart $cart, Product $product): CartUnit
    {
        $cartUnit = $this->cartUnitFactory->fromArgs($cart->id(), $product);
        $cart->getDto()->setUnitsAmount($cart->unitsAmount()->value() + 1);
        $cart->getDto()->setTotalSum($cart->totalSum()->value() + $cartUnit->itemPrice()->value());

        return $cartUnit;
    }
}