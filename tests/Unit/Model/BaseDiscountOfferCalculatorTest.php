<?php
declare(strict_types=1);

namespace App\Tests\Unit\Model;

use App\Entity\Product;
use App\Model\BaseDiscountOfferCalculator;
use App\Model\DiscountOfferCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BaseDiscountOfferCalculatorTest extends TestCase
{
    private DiscountOfferCalculator $sut;

    protected function setUp(): void
    {
        $this->sut = new BaseDiscountOfferCalculator();
        parent::setUp();
    }

    /**
     * @param array<Product> $productList
     */
    #[DataProvider('totalDataProvider')]
    public function testShippingCostStrategiesProvidesCorrectValue(array $productList, float $expectedDiscount): void
    {
        $actualShippingCosts = $this->sut->calculate($productList);

        $this->assertEquals($expectedDiscount, $actualShippingCosts);
    }

    /**
     * @return array<string, array<string,array<Product>|float>>
     */
    public static function totalDataProvider(): array
    {
        $aRedProduct = new Product();
        $aRedProduct->setCode('R01');
        $aRedProduct->setName('RedOne');
        $aRedProduct->setPrice(10.0);


        $aGreenProduct = new Product();
        $aGreenProduct->setCode('G01');
        $aGreenProduct->setName('GreenOne');
        $aGreenProduct->setPrice(100.0);

        return [
            'Two red products gives discount'        => ['productList' => [$aRedProduct, $aRedProduct], 'expectedDiscount' => 5.0],
            'Three red products gives discount once' => ['productList' => [$aRedProduct, $aRedProduct, $aRedProduct], 'expectedDiscount' => 5.0],
            'Four red products gives discount once'  => ['productList' => [$aRedProduct, $aRedProduct, $aRedProduct, $aRedProduct], 'expectedDiscount' => 10.0],
            'Two green products dont gives discount' => ['productList' => [$aGreenProduct, $aGreenProduct], 'expectedDiscount' => .0],
            'Mixed products dont gives discount'     => ['productList' => [$aRedProduct, $aGreenProduct], 'expectedDiscount' => .0],
        ];
    }
}
