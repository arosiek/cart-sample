<?php
declare(strict_types=1);

namespace App\App;

use App\Model\Basket;
use App\Model\BasketFactory;
use App\Model\RegularBasketFactory;

class SimpleCartFacade implements CartFacade
{
    private Basket $regularBasket;

    public function __construct()
    {
        $this->regularBasket = $this->createBasketFactory()->createRegularBasket();
    }

    public function add(string $code): void
    {
        $this->regularBasket->add($code);
    }

    public function total(): float
    {
        return $this->regularBasket->total();
    }

    private function createBasketFactory(): BasketFactory
    {
        return new RegularBasketFactory();
    }
}
