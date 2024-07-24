<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Entity\Product;

interface DiscountOfferStrategy
{
    /**
     * @param array<Product> $productList
     */
    public function calculate(array $productList): float;
}