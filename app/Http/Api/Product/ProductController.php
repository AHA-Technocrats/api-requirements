<?php

namespace App\Http\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Api\Product\ProductQuery;
use App\Http\Api\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function __invoke(Request $request, ProductQuery $query): AnonymousResourceCollection
    {
        return ProductResource::collection($query->fetch($request->all()));
    }
}
