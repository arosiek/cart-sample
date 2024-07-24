<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Exception\ProductNotFoundException;

interface ProductRepository
{
    /**
     * @throws ProductNotFoundException
     */
    public function getProductByCode(string $code): Product;
}