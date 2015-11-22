<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\CatalogBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use WellCommerce\CatalogBundle\Entity\Attribute\GroupInterface;
use WellCommerce\CommonBundle\Entity\ShopCollectionAwareTrait;
use WellCommerce\CommonBundle\Entity\TaxInterface;
use WellCommerce\AppBundle\Doctrine\ORM\Behaviours\EnableableTrait;
use WellCommerce\AppBundle\Doctrine\ORM\Behaviours\PhotoTrait;
use WellCommerce\AppBundle\Entity\Dimension;
use WellCommerce\AppBundle\Entity\DiscountablePrice;
use WellCommerce\AppBundle\Entity\HierarchyAwareTrait;
use WellCommerce\AppBundle\Entity\Price;

/**
 * Class Product
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Product implements ProductInterface
{
    use Translatable;
    use Timestampable;
    use Blameable;
    use PhotoTrait;
    use EnableableTrait;
    use HierarchyAwareTrait;
    use ShopCollectionAwareTrait;
    use ProducerAwareTrait;
    use UnitAwareTrait;
    use AvailabilityAwareTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var Collection
     */
    protected $categories;

    /**
     * @var Collection
     */
    protected $statuses;

    /**
     * @var Collection
     */
    protected $productPhotos;

    /**
     * @var Collection
     */
    protected $attributes;

    /**
     * @var Collection
     */
    protected $reviews;

    /**
     * @var float
     */
    protected $stock;

    /**
     * @var Price
     */
    protected $buyPrice;

    /**
     * @var TaxInterface
     */
    protected $buyPriceTax;

    /**
     * @var DiscountablePrice
     */
    protected $sellPrice;

    /**
     * @var TaxInterface
     */
    protected $sellPriceTax;

    /**
     * @var GroupInterface
     */
    protected $attributeGroup;

    /**
     * @var bool
     */
    protected $trackStock;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var Dimension
     */
    protected $dimension;

    /**
     * @var float
     */
    protected $packageSize;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * {@inheritdoc}
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * {@inheritdoc}
     */
    public function setStock($stock)
    {
        $this->stock = (int)$stock;
    }

    /**
     * {@inheritdoc}
     */
    public function getTrackStock()
    {
        return (bool)$this->trackStock;
    }

    /**
     * {@inheritdoc}
     */
    public function setTrackStock($trackStock)
    {
        $this->trackStock = $trackStock;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatuses(Collection $statuses)
    {
        $this->statuses = $statuses;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductPhotos()
    {
        return $this->productPhotos;
    }

    /**
     * {@inheritdoc}
     */
    public function setProductPhotos(Collection $photos)
    {
        $this->productPhotos = $photos;
    }

    /**
     * {@inheritdoc}
     */
    public function addProductPhoto(ProductPhoto $photo)
    {
        $this->productPhotos[] = $photo;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategories(Collection $collection)
    {
        $this->categories = $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function addCategory(CategoryInterface $category)
    {
        $this->categories[] = $category;
    }

    /**
     * {@inheritdoc}
     */
    public function getSellPrice()
    {
        return $this->sellPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function setSellPrice(DiscountablePrice $sellPrice)
    {
        $this->sellPrice = $sellPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuyPrice()
    {
        return $this->buyPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function setBuyPrice(Price $buyPrice)
    {
        $this->buyPrice = $buyPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeight($weight)
    {
        $this->weight = (float)$weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * {@inheritdoc}
     */
    public function setDimension(Dimension $dimension)
    {
        $this->dimension = $dimension;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageSize()
    {
        return $this->packageSize;
    }

    /**
     * {@inheritdoc}
     */
    public function setPackageSize($packageSize)
    {
        $this->packageSize = (float)$packageSize;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributeGroup(GroupInterface $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(Collection $attributes)
    {
        if (null !== $this->attributes) {
            $this->attributes->map(function (ProductAttributeInterface $productAttribute) use ($attributes) {
                if (false === $attributes->contains($productAttribute)) {
                    $this->removeAttribute($productAttribute);
                }
            });
        }

        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute(ProductAttributeInterface $productAttribute)
    {
        $this->attributes->removeElement($productAttribute);
    }

    /**
     * {@inheritdoc}
     */
    public function getBuyPriceTax()
    {
        return $this->buyPriceTax;
    }

    /**
     * {@inheritdoc}
     */
    public function setBuyPriceTax(TaxInterface $buyPriceTax)
    {
        $this->buyPriceTax = $buyPriceTax;
    }

    /**
     * {@inheritdoc}
     */
    public function getSellPriceTax()
    {
        return $this->sellPriceTax;
    }

    /**
     * {@inheritdoc}
     */
    public function setSellPriceTax(TaxInterface $sellPriceTax)
    {
        $this->sellPriceTax = $sellPriceTax;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCostQuantity()
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCostWeight()
    {
        return $this->weight;
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCostGrossPrice()
    {
        return $this->sellPrice->getFinalGrossAmount();
    }

    /**
     * {@inheritdoc}
     */
    public function getShippingCostCurrency()
    {
        return $this->sellPrice->getCurrency();
    }

    /**
     * {@inheritdoc}
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
