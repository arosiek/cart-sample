<?php
declare(strict_types=1);

namespace App\Model;

use App\Repository\JsonProductRepository;
use App\Repository\ProductRepository;

class BasketFactory
{
    public function createRegularBasket(): Basket
    {
        return new RegularBasket(
            $this->createProductCatalogueFilterable(),
            $this->createShippingCostCalculator(),
            $this->createDiscountOfferCalculator(),
        );
    }

    private function createProductCatalogueFilterable(): ProductCatalogueFilterable
    {
        return new ProductCatalogue(
            $this->createProductRepository(),
        );
    }

    private function createProductRepository(): ProductRepository
    {
        return new JsonProductRepository();
    }

    private function createShippingCostCalculator(): ShippingCostCalculator
    {
        return new BaseShippingCostCalculator();
    }

    private function createDiscountOfferCalculator(): DiscountOfferCalculator
    {
        return new BaseDiscountOfferCalculator();
    }
}