<?php

namespace App\Http\Controllers\Products;

use App\Http\Exceptions\ProductStoreException;
use App\Http\Request\ProductStoreRequest;
use App\Models\Product;

final class ProductStoreController
{
    public function __construct(Private readonly Product $product)
    {
    }

    /**
     * @throws ProductStoreException
     */
    public function __invoke(ProductStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $store = $this->product->create($request->toArray());

        if (!$store) {
            throw new ProductStoreException("Ha sucedido un error guardando el producto", 500);
        }

        return response($store->toArray(), 201);
    }
}
