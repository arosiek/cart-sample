<?php
declare(strict_types=1);

namespace App\Strategy;

final class MediumTotalShippingCostStrategy implements ShippingCostStrategy
{
    private const  SHIPPING_COST = 2.95;

    public function calculateShippingCost(float $total): float
    {
        return self::SHIPPING_COST;
    }
}