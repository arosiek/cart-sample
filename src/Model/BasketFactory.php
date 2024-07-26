<?php
declare(strict_types=1);

namespace App\Model;

use App\Repository\JsonProductRepository;
use App\Repository\ProductRepository;

interface BasketFactory
{
    public function createRegularBasket(): Basket;
}
