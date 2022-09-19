<?php

namespace App\Http\Api\Product;

use App\Models\Product;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\QueryBuilder;

class ProductQuery
{
    public function fetch(array $params)
    {
        return QueryBuilder::for(Product::class)
            ->allowedFilters(Product::$allowedFilters)
            ->defaultSort('created_at')
            ->paginate(Arr::get($params, 'count', config('app.pagination.default_count')));
    }
}
