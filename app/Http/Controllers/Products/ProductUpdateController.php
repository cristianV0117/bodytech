<?php

namespace App\Http\Controllers\Products;

use App\Http\Exceptions\ProductUpdateException;
use App\Http\Request\ProductUpdateRequest;
use App\Models\Product;

final class ProductUpdateController
{
    public function __construct(private readonly Product $product)
    {
    }

    /**
     * @throws ProductUpdateException
     */
    public function __invoke(
        ProductUpdateRequest $request,
        int $id
    )
    {
        $product = $this->product->find($id);

        if (!$product) {
            throw new ProductUpdateException("El prodcuto no existe", 404);
        }

        $update = $product->update($request->toArray());

        if (!$update) {
            throw new ProductUpdateException("Ha sucedido un error editando el producto", 500);
        }

        return response([
            "message" => "Producto editado",
            "status" => 200
        ], 200);
    }
}
