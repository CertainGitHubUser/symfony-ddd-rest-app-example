<?php

namespace App\Module\Product\Infrastructure\Repository;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use App\Module\Common\Domain\ValueObject\PaginationOffset;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Product\Domain\Model\Exception\ProductByTitleNotFoundException;
use App\Module\Product\Domain\Model\Exception\ProductNotFoundException;
use App\Module\Product\Domain\Model\Exception\ProductsCollectionMinimalItemsAmountException;
use App\Module\Product\Domain\Model\Product;
use App\Module\Product\Domain\Model\ProductFactoryInterface;
use App\Module\Product\Domain\Model\ProductId;
use App\Module\Product\Domain\Model\ProductRepositoryInterface;
use App\Module\Product\Domain\Model\ProductsCollection;
use App\Module\Product\Domain\Model\ProductsCollectionFactoryInterface;
use App\Module\Product\Domain\Model\ProductsPaginatedCollection;
use App\Module\Product\Domain\Model\ProductsPaginatedCollectionFactoryInterface;
use App\Module\Product\Domain\Model\ProductTitle;
use App\Module\Product\Infrastructure\Entity\ProductEntity;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineProductRepository implements ProductRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private ProductFactoryInterface $productFactory;
    private ProductsPaginatedCollectionFactoryInterface $productsPaginatedCollectionFactory;
    private ProductsCollectionFactoryInterface $productsCollectionFactory;

    public function __construct(
        EntityManagerInterface $manager,
        ProductFactoryInterface $productFactory,
        ProductsPaginatedCollectionFactoryInterface $productsPaginatedCollectionFactory,
        ProductsCollectionFactoryInterface $productsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(ProductEntity::class);

        $this->productFactory = $productFactory;
        $this->productsPaginatedCollectionFactory = $productsPaginatedCollectionFactory;
        $this->productsCollectionFactory = $productsCollectionFactory;
    }

    public function getProductsAmount(): UnsignedInt
    {
        $qb = $this->manager->createQueryBuilder();
        $amount = $qb->select('COUNT(s)')->from(ProductEntity::class, 's')->getQuery()
            ->getResult(AbstractQuery::HYDRATE_SINGLE_SCALAR);

        return new UnsignedInt($amount);
    }

    public function getCollection(array $productIds): ProductsCollection
    {
        if (empty($productIds)) {
            return $this->productsCollectionFactory->fromDtoList([]);
        }

        $productIdsAsIntArray = [];

        foreach ($productIds as $productId) {
            $productIdsAsIntArray[] = $productId->value();
        }

        $productEntityList = $this->doctrineRepository->findBy(['id' => $productIdsAsIntArray]);

        return $this->productsCollectionFactory->fromDtoList($productEntityList);
    }

    /**
     * @param PaginationLimit $limit
     * @param PaginationOffset $offset
     * @return ProductsPaginatedCollection
     * @throws ProductsCollectionMinimalItemsAmountException
     */
    public function getPaginatedCollection(PaginationLimit $limit, PaginationOffset $offset): ProductsPaginatedCollection
    {
        $itemsAmount = $this->getProductsAmount();

        if ($itemsAmount->value() < ProductsPaginatedCollection::MINIMAL_ITEMS_AMOUNT) {
            throw new ProductsCollectionMinimalItemsAmountException($itemsAmount);
        }

        $qb = $this->manager->createQueryBuilder();
        $qb->select('s')->from(ProductEntity::class, 's');
        $query = $qb->getQuery();

        $query->setFirstResult($offset->value())
            ->setMaxResults($limit->value());

        $productEntityList = $query->getResult();

        return $this->productsPaginatedCollectionFactory->fromArgs($productEntityList, $itemsAmount, $offset, $limit);
    }

    public function get(ProductId $productId): Product
    {
        $productEntity = $this->doctrineRepository->find($productId->value());

        if (empty($productEntity)) {
            throw new ProductNotFoundException($productId);
        }

        return $this->productFactory->fromDto($productEntity);
    }

    public function getByTitle(ProductTitle $title): Product
    {
        $productEntity = $this->doctrineRepository->findOneBy(['title' => $title->value()]);

        if (empty($productEntity)) {
            throw new ProductByTitleNotFoundException($title);
        }

        return $this->productFactory->fromDto($productEntity);
    }

    public function hasProduct(ProductTitle $title): bool
    {
        try {
            $this->getByTitle($title);
        } catch (ProductByTitleNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function save(Product $product): void
    {
        $this->manager->persist($product->getDto());
        $this->manager->flush();
    }

    public function remove(Product $product): void
    {
        $this->manager->remove($product->getDto());
        $this->manager->flush();
    }
}