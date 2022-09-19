<?php

namespace Domain\Product\Controllers;

use App\Http\Controllers\Controller;
use Domain\Product\Queries\ProductIndexQuery;
use Domain\Product\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductIndexController extends Controller
{
    public function __invoke(Request $request, ProductIndexQuery $query): AnonymousResourceCollection
    {
        return ProductResource::collection($query->fetch($request->all()));
    }
}
