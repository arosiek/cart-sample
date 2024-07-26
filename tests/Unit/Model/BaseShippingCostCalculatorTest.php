<?php
declare(strict_types=1);

namespace App\Tests\Unit\Model;

use App\Model\BaseShippingCostCalculator;
use App\Model\ShippingCostCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BaseShippingCostCalculatorTest extends TestCase
{
    private ShippingCostCalculator $sut;

    protected function setUp(): void
    {
        $this->sut = new BaseShippingCostCalculator();
        parent::setUp();
    }

    #[DataProvider('totalDataProvider')]
    public function testShippingCostStrategiesProvidesCorrectValue(float $total, float $expectedShippingCost): void
    {
        $actualShippingCosts = $this->sut->calculate($total);

        $this->assertEquals($expectedShippingCost, $actualShippingCosts);
    }

    /**
     * @return array<string, array<string,float>>
     */
    public static function totalDataProvider(): array
    {
        return [
            'Low shipping cost strategy is calculated'    => ['total' => 10.0, 'expectedShippingCost' => 4.95],
            'Medium shipping cost strategy is calculated on boundary value' => ['total' => 50.0, 'expectedShippingCost' => 2.95],
            'Medium shipping cost strategy is calculated' => ['total' => 51.0, 'expectedShippingCost' => 2.95],
            'High shipping cost strategy is calculated on boundary value'   => ['total' => 90.0, 'expectedShippingCost' => .0],
            'High shipping cost strategy is calculated'   => ['total' => 91.0, 'expectedShippingCost' => .0],
        ];
    }
}
