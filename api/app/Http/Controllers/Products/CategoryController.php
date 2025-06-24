<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CategoryRequest;
use App\Http\Resources\Products\CategoryResource;
use App\Http\Services\Products\CategoryService;
use App\Models\Products\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return CategoryResource::collection($this->service->list());
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->service->create($request->validated());
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $updated = $this->service->update($category, $request->validated());
        return new CategoryResource($updated);
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return response()->json(['message' => 'Categoría eliminada'], 204);
    }
}
