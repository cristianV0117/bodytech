<?php

namespace App\Http\Controllers\Products;

use App\Http\Exceptions\ProductDeleteException;
use App\Models\Product;

final class ProductDeleteController
{
    public function __construct(private readonly Product $product)
    {
    }

    /**
     * @throws ProductDeleteException
     */
    public function __invoke(int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $product = $this->product->find($id);

        if (!$product) {
            throw new ProductDeleteException("El prodcuto no existe", 404);
        }

        $product->status = 0;
        $product->save();

        return response([
            "message" => "Producto actualizado",
            "status" => "200"
        ],200);
    }
}
