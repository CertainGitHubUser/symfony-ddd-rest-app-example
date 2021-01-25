<?php

namespace App\Module\Product\Application\UseCase\DeleteProduct;

use App\Module\Cart\Application\Facade\CartFacade;
use App\Module\Product\Domain\Model\Exception\CartsHasProductException;
use App\Module\Product\Domain\Model\ProductRepositoryInterface;

final class DeleteProduct
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(DeleteProductRequest $request): void
    {
        $product = $this->productRepository->get($request->getProductId());

        if (CartFacade::instance()->cartsHasProduct($product->id()->value())) {
            throw new CartsHasProductException($product->id());
        }

        $this->productRepository->remove($product);
    }
}