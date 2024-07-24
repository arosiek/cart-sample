<?php
declare(strict_types=1);

namespace App\Strategy;

final class LowTotalShippingCostStrategy implements ShippingCostStrategy
{
    private const SHIPPING_COST = 4.95;

    public function calculateShippingCost(float $total): float
    {
        return self::SHIPPING_COST;
    }
}