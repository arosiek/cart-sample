<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;

final class RegularBasket implements Basket
{
    /** @var array<Product> */
    private array $items = [];

    public function __construct(
        private readonly ProductCatalogueFilterable $productCatalogue,
    )
    {
    }

    public function add(string $code): void
    {
        $this->items[] = $this->productCatalogue->getProductByCode($code);
    }

    public function total(): float
    {
        $total = .0;

        foreach ($this->items as $item) {
            $total += round($item->getPrice(), 2);
        }

        return round($total, 2);
    }
}