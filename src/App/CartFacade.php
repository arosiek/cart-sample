<?php
declare(strict_types=1);

namespace App\App;

use App\Model\BasketFactory;

interface CartFacade
{
    public function add(string $code): void;

    public function total(): float;
}
