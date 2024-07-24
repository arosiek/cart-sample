<?php
declare(strict_types=1);

namespace App\Model;

interface Basket
{
    public function add(string $code): void;

    public function total(): float;
}