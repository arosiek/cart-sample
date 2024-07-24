<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;
use App\Exception\ProductNotFoundException;

interface ProductCatalogueFilterable
{
    /**
     * @throws ProductNotFoundException
     */
    public function getProductByCode(string $code): Product;
}