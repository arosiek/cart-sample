<?php
declare(strict_types=1);

namespace App\Tests\Model;

use App\Entity\Product;
use App\Exception\ProductNotFoundException;
use App\Model\ProductCatalogue;
use App\Model\ProductCatalogueFilterable;
use App\Repository\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ProductCatalogueTest extends TestCase
{
    private ProductRepository&MockObject $productRepository;
    private ProductCatalogueFilterable $sut;

    protected function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->sut = new ProductCatalogue($this->productRepository);

        parent::setUp();
    }

    public function testGetProductByCodeDueExistingProduct(): void
    {
        $aProduct = new Product();
        $aProduct->setCode('IExists');

        $this->productRepository->expects($this->once())
            ->method('getProductByCode')
            ->with($aProduct->getCode())
            ->willReturn($aProduct);

        $anExpectedProduct = $this->sut->getProductByCode($aProduct->getCode());

        $this->assertSame($anExpectedProduct, $aProduct);
    }

    public function testProductNotFoundExceptionDueNotExistingProduct(): void
    {
        $productCode = 'IDontExists';
        $this->productRepository->expects($this->once())
            ->method('getProductByCode')
            ->with($productCode)
            ->willThrowException(new ProductNotFoundException());

        $this->expectException(ProductNotFoundException::class);
        $this->sut->getProductByCode('IDontExists');
    }
}
