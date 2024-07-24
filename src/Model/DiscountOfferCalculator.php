<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;

interface DiscountOfferCalculator
{
    /**
     * @param array<Product> $productList
     */
    public function calculate(array $productList): float;
}