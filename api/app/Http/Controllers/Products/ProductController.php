<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Http\Services\Products\ProductService;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = $this->service->list();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = $this->service->find($id);
        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->service->create($request->validated());
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $updated = $this->service->update($product, $request->validated());
        return new ProductResource($updated);
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(['message' => 'Producto eliminado']);
    }
}
