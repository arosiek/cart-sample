<?php
declare(strict_types=1);

namespace App\Unit\Tests\Itegration\App;

use App\App\CartFacade;
use App\App\SimpleCartFacade;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SimpleCartFacadeTest extends TestCase
{

    private CartFacade $sut;

    protected function setUp(): void
    {
        $this->sut = new SimpleCartFacade();

        parent::setUp();
    }


    /**
     * @param array<string> $productCodes
     */
    #[DataProvider('basketsProvider')]
    public function testTotalCalculation(array $productCodes, float $total): void
    {
        foreach ($productCodes as $productCode) {
            $this->sut->add($productCode);
        }

        $actualTotal = $this->sut->total();

        $this->assertSame($total, $actualTotal);
    }

    /**
     * @return array<string,array<string,array<string>|float>>
     */
    public static function basketsProvider(): array
    {
        return [
            'Simple basket with free shipping' => ['productCodes' => ['G01', 'G01', 'G01', 'G01'], 'total' => 99.8],
            'Simple basket with high delivery costs' => ['productCodes' => ['B01', 'G01'], 'total' => 37.85],
            'Simple basket with medium delivery costs and second price half offer' => ['productCodes' => ['R01', 'R01'], 'total' => 54.37],
            'Simple basket with medium delivery costs' => ['productCodes' => ['R01', 'G01'], 'total' => 60.85],
            'Simple basket with high delivery costs and second price half offer' => ['productCodes' => ['B01', 'B01', 'R01', 'R01', 'R01'], 'total' => 98.27],
        ];
    }
}
