<?php
declare(strict_types=1);

namespace App\Model;

interface ShippingCostCalculator
{
    public function calculate(float $total): float;
}