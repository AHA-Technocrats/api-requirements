<?php

namespace Domain\Product\Models;

use Domain\Product\Business\Discounts;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRICE_CURRENCY = 'EUR';

    public static $allowedFilters = [
        'category',
        'price',
    ];

    /**
     * Get the user's first name.
     *
     * @return Attribute
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => [
                'original' => $value,
                'currency' => Product::PRICE_CURRENCY,
            ] + (new Discounts($value, $this->category, $this->sku))->execute(),
        );
    }
}
