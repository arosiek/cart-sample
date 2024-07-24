<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;
use App\Repository\ProductRepository;

final class ProductCatalogue implements ProductCatalogueFilterable
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function getProductByCode(string $code): Product
    {
        return $this->productRepository->getProductByCode($code);
    }
}