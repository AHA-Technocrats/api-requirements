<?php

namespace App\Http\Api\Product;

class ProductDiscounts
{
    const TERMS = [
        'category' => [
            0 => ['vehicle'],
            30 => ['insurance'],
        ],
        'sku' => [
            15 => ['000003'],
        ],
    ];

    public array $value;

    /**
     * Setting up initial value for discount fields
     *
     * @param $price
     * @param $category
     * @param $sku
     */
    public function __construct(public $price, public $category, public $sku)
    {
        $this->value = [
            'final' => $this->price,
            'discount' => null,
        ];
    }

    public function execute(): array
    {
        $this->applyCategoryDiscounts();
        $this->applySKUDiscounts();

        return $this->value;
    }

    /**
     * Applying discount for Category
     *
     * @return void
     */
    protected function applyCategoryDiscounts()
    {
        foreach (ProductDiscounts::TERMS['category'] as $index => $key) {
            if (in_array($this->category, $key)) {
                $this->value['final'] = $this->price - ($this->price / 100) * $index;
                $this->value['discount'] = $index.'%';

                break;
            }
        }
    }

    /**
     * Applying discount for SKU
     *
     * @return void
     */
    protected function applySKUDiscounts()
    {
        foreach (ProductDiscounts::TERMS['sku'] as $index => $key) {
            if (in_array($this->sku, $key)) {
                $this->value['final'] = $this->price - ($this->price / 100) * $index;
                $this->value['discount'] = $index.'%';

                break;
            }
        }
    }
}
