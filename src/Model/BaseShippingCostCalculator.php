<?php
declare(strict_types=1);

namespace App\Model;

use App\Strategy\HighTotalShippingCostStrategy;
use App\Strategy\LowTotalShippingCostStrategy;
use App\Strategy\MediumTotalShippingCostStrategy;
use App\Strategy\ShippingCostStrategy;

final class BaseShippingCostCalculator implements ShippingCostCalculator
{
    private const LOW_TOTAL_LIMIT = 50;
    private const MEDIUM_TOTAL_LIMIT = 90;
    private const HIGH_TOTAL_LIMIT = PHP_INT_MAX;
    /**
     * @var ShippingCostStrategy[]
     */
    private array $strategies;

    public function __construct()
    {
        $this->strategies = [
            self::LOW_TOTAL_LIMIT => new LowTotalShippingCostStrategy(),
            self::MEDIUM_TOTAL_LIMIT => new MediumTotalShippingCostStrategy(),
            self::HIGH_TOTAL_LIMIT => new HighTotalShippingCostStrategy(),
        ];
    }

    public function calculate(float $total): float
    {
        foreach ($this->strategies as $limit => $strategy) {
            if ($limit - $total > 0) {
                return $strategy->calculateShippingCost($total);
            }
        }

        return 0.0;
    }
}