<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Exception\FileNotExistsException;
use App\Exception\ProductNotFoundException;

final class JsonProductRepository implements ProductRepository
{
    public function __construct(
        private string $filePath = __DIR__ . '/../../data/products.json'
    )
    {
    }

    public function getProductByCode(string $code): Product
    {
        $filtered = array_filter(
            $this->getAllProducts(),
            fn($product) => $product->getCode() === $code
        );

        if (count($filtered) === 0) {
            throw new ProductNotFoundException(sprintf("Product %s not found", $code));
        }

        return reset($filtered);
    }

    /**
     * @throws FileNotExistsException
     *
     * @return array<int,Product>
     */
    private function getAllProducts(): array
    {
        if (!file_exists($this->filePath)) {
            throw new FileNotExistsException(sprintf("File %s not exists or not readable", $this->filePath));
        }

        $json = (string)file_get_contents($this->filePath);
        $data = (array)json_decode($json, true);

        return array_map([$this, 'mapToProduct'], $data);
    }

    /**
     * @param array{name: string, code: string, price: float} $productData
     */
    private function mapToProduct(array $productData): Product
    {
        $product = new Product();
        $product->setName($productData['name']);
        $product->setCode($productData['code']);
        $product->setPrice($productData['price']);

        return $product;
    }
}