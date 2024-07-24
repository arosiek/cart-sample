<?php
declare(strict_types=1);

namespace App\Strategy;

final class DiscountOnEachSecondProductOfferStrategy implements DiscountOfferStrategy
{
    private function __construct(
        private string $productCode
    )
    {

    }

    public static function createByProductCode(string $productCode): self
    {
        return new self($productCode);
    }

    public function calculate(array $productList): float
    {
        $filtered = array_filter($productList, fn($product) => $product->getCode() === $this->productCode);
        $qty = count($filtered);

        if ($qty === 0) {
            return .0;
        }

        $includedToPromotionQty = (int)floor($qty / 2);
        $promoProduct = reset($filtered);

        return round(0.5 * $promoProduct->getPrice() * $includedToPromotionQty, 2);
    }
}
