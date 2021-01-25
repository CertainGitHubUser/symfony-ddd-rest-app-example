<?php

namespace App\Module\Product\Infrastructure\Entity;

use App\Module\Product\Domain\Model\ProductCurrency;
use App\Module\Product\Domain\Model\ProductDtoInterface;
use App\Module\Product\Domain\Model\ProductId;
use App\Module\Product\Domain\Model\ProductPrice;
use App\Module\Product\Domain\Model\ProductTitle;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("product")
 */
class ProductEntity implements ProductDtoInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $title;

    /**
     * @ORM\Column(type="float", options={"unsigned": true})
     */
    private float $price;

    public function getId(): ProductId
    {
        return ProductId::fromString($this->id);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = ProductId::fromString($id)->value();
    }

    public function getTitle(): ProductTitle
    {
        return ProductTitle::fromString($this->title);
    }

    public function setTitle(string $title): void
    {
        $this->title = ProductTitle::fromString($title)->value();
    }

    public function getPrice(): ProductPrice
    {
        return ProductPrice::fromString($this->price);
    }

    public function setPrice(float $price): void
    {
        $this->price = ProductPrice::fromString($price)
            ->value();
    }

    public function getCurrency(): ProductCurrency
    {
        return ProductCurrency::fromString(ProductCurrency::DEFAULT_CURRENCY);
    }
}