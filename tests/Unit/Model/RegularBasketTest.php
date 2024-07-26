<?php
declare(strict_types=1);

namespace App\Tests\Unit\Model;

use App\Entity\Product;
use App\Model\Basket;
use App\Model\DiscountOfferCalculator;
use App\Model\ProductCatalogueFilterable;
use App\Model\RegularBasket;
use App\Model\ShippingCostCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class RegularBasketTest extends TestCase
{
    private ProductCatalogueFilterable&MockObject $productCatalogue;
    private ShippingCostCalculator&MockObject $shippingCostCalculator;
    private DiscountOfferCalculator&MockObject $discountCalculator;
    private Basket $sut;

    protected function setUp(): void
    {
        $this->productCatalogue = $this->createMock(ProductCatalogueFilterable::class);
        $this->shippingCostCalculator = $this->createMock(ShippingCostCalculator::class);
        $this->discountCalculator = $this->createMock(DiscountOfferCalculator::class);

        $this->sut = new RegularBasket(
            $this->productCatalogue,
            $this->shippingCostCalculator,
            $this->discountCalculator
        );

        parent::setUp();
    }

    #[DataProvider('calculationDataProvider')]
    public function testTotalsCalculation(float $productPrice, float $shippingCost, float $discount, float $expectedTotal): void
    {
        $aProduct = new Product();
        $aProduct->setPrice($productPrice);

        $this->productCatalogue->expects($this->once())
            ->method('getProductByCode')
            ->willReturn($aProduct);
        $this->discountCalculator->expects($this->once())
            ->method('calculate')
            ->with([$aProduct])
            ->willReturn($discount);
        $this->shippingCostCalculator->expects($this->once())
            ->method('calculate')
            ->with($productPrice - $discount)
            ->willReturn($shippingCost);

        $this->sut->add('SomeCode');

        $actualTotal = $this->sut->total();

        $this->assertEquals($expectedTotal, $actualTotal);
    }

    /**
     * @return array<string,array<string,float>>
     */
    public static function calculationDataProvider(): array
    {
        return [
            'No shipping, no discount' => ['productPrice' => 100.0, 'shippingCost' => .0, 'discount' => .0, 'expectedTotal' => 100.0],
            'Shipping, no discount'    => ['productPrice' => 100.0, 'shippingCost' => 10.0, 'discount' => .0, 'expectedTotal' => 110.0],
            'No shipping, Discount'    => ['productPrice' => 100.0, 'shippingCost' => .0, 'discount' => 10.0, 'expectedTotal' => 90.0],
            'Shipping, Discount'       => ['productPrice' => 100.0, 'shippingCost' => 10.0, 'discount' => 5.0, 'expectedTotal' => 105.0],
        ];
    }

    public function testAddToCartIsTriggeringCatalogue(): void
    {
        $this->productCatalogue->expects($this->exactly(3))
            ->method('getProductByCode')
            ->willReturn(new Product());

        $this->sut->add('R01');
        $this->sut->add('G01');
        $this->sut->add('G01');

        $sutReflection = new ReflectionClass($this->sut);
        $property = $sutReflection->getProperty('items');
        $actualItems = (array)$property->getValue($this->sut);

        $this->assertEquals(3, count($actualItems));
    }
}
