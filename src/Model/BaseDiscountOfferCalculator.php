<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;
use App\Strategy\DiscountOnEachSecondProductOfferStrategy;

final class BaseDiscountOfferCalculator implements DiscountOfferCalculator
{
    /**
     * @param array<Product> $productList
     */
    public function calculate(array $productList): float
    {
        return DiscountOnEachSecondProductOfferStrategy::createByProductCode('R01')
            ->calculate($productList);
    }
}