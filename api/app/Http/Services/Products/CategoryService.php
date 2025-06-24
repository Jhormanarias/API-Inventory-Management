<?php

namespace App\Http\Services\Products;

use App\Models\Products\Category;
use Exception;
use Illuminate\Database\QueryException;

class CategoryService
{
    public function list()
    {
        try {
            return Category::all();
        } catch (QueryException $e) {
            throw new Exception("Error al listar categorías");
        }
    }

    public function create(array $data): Category
    {
        try {
            return Category::create($data);
        } catch (QueryException $e) {
            throw new Exception("Error al crear la categoría: " . $e->getMessage());
        }
    }

    public function update(Category $category, array $data): Category
    {
        try {
            $category->update($data);
            return $category;
        } catch (QueryException $e) {
            throw new Exception("Error al actualizar la categoría");
        }
    }

    public function delete(Category $category): void
    {
        try {
            $category->delete();
        } catch (QueryException $e) {
            throw new Exception("Error al eliminar la categoría");
        }
    }
}
