<?php

namespace App\Module\Cart\Application\UseCase\Cart\GetCartDetails;

use App\Module\Cart\Domain\Model\Cart\CartRepositoryInterface;
use App\Module\Cart\Domain\Model\CartDetails\CartDetails;
use App\Module\Cart\Domain\Model\CartDetails\CartDetailsFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitRepositoryInterface;
use App\Module\Product\Application\Facade\ProductFacade;

final class GetCartDetails
{
    private CartRepositoryInterface $cartRepository;

    private CartUnitRepositoryInterface $cartUnitRepository;

    private CartDetailsFactoryInterface $cartDetailsFactory;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartUnitRepositoryInterface $cartUnitRepository,
        CartDetailsFactoryInterface $cartDetailsFactory
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartUnitRepository = $cartUnitRepository;
        $this->cartDetailsFactory = $cartDetailsFactory;
    }

    public function handle(GetCartDetailsRequest $request): CartDetails
    {
        $cart = $this->cartRepository->get($request->getCartId());
        $cartUnits = $this->cartUnitRepository->getCartUnits($cart->id());

        $products = ProductFacade::instance()->getProductsCollection($cartUnits->getProductIdsAsIntArray());

        return $this->cartDetailsFactory->fromArgs($cart, $cartUnits, $products);
    }
}