<?php
declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\Product;
use App\Exception\FileNotExistsException;
use App\Exception\ProductNotFoundException;
use App\Repository\JsonProductRepository as JsonProductRepository;
use App\Repository\ProductRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class JsonProductRepositoryTest extends TestCase
{
    private ProductRepository $sut;

    protected function setUp(): void
    {
        $this->sut = new JsonProductRepository(__DIR__ . '/../../data/products.json');

        parent::setUp();
    }

    public function testProductNotFoundExceptionDueNonExistingProduct(): void
    {
        $this->expectException(ProductNotFoundException::class);

        $this->sut->getProductByCode('IDontExists');
    }

    public function testFileNotExistsExceptionDueNonExistingFile(): void
    {
        $this->expectException(FileNotExistsException::class);

        $this->sut = new JsonProductRepository(__DIR__ . '/../../data/iDontExists.json');
        $this->sut->getProductByCode('Anything');
    }

    #[DataProvider('productDataProvider')]
    public function testProductFountDueExistingCode(string $productCode): void
    {
        $product = $this->sut->getProductByCode($productCode);

        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * @return array<string,array<string>>
     */
    public static function productDataProvider(): array
    {
        return [
            'Red widget product exists' => ['R01'],
            'Green widget product exists' => ['G01'],
            'Blue widget product exists' => ['B01'],
        ];
    }
}
