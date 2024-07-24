<?php
declare(strict_types=1);

namespace App\Strategy;

final class HighTotalShippingCostStrategy implements ShippingCostStrategy
{
    private const  SHIPPING_COST = .0;

    public function calculateShippingCost(float $total): float
    {
        return self::SHIPPING_COST;
    }
}