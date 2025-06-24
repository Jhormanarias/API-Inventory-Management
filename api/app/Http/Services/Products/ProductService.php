<?php

namespace App\Http\Services\Products;

use App\Models\Products\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProductService
{
    public function list()
    {
        try {
            return Product::with('category')->latest()->get();
        } catch (QueryException $e) {
            throw new Exception("Error al obtener productos");
        }
    }

    public function find($id)
    {
        try {
            return Product::with('category')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception("Producto no encontrado");
        } catch (QueryException $e) {
            throw new Exception("Error al buscar el producto");
        }
    }

    public function create(array $data)
    {
        try {
            return Product::create($data);
        } catch (QueryException $e) {
            throw new Exception("Error al crear el producto");
        }
    }

    public function update(Product $product, array $data)
    {
        try {
            $product->update($data);
            return $product;
        } catch (QueryException $e) {
            throw new Exception("Error al actualizar el producto");
        }
    }

    public function delete(Product $product)
    {
        try {
            return $product->delete();
        } catch (QueryException $e) {
            throw new Exception("Error al eliminar el producto");
        }
    }
}
