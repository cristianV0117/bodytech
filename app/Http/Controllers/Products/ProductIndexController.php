<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;

final class ProductIndexController
{
    public function __construct(Private readonly Product $product)
    {
    }

    public function __invoke(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response($this->product->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }])->where('status', 1)->get()->toArray(), 200);
    }
}
