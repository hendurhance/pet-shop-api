<?php

namespace App\Http\Controllers\API\V1\User\Product;

use App\Contracts\Repositories\User\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Product\CreateProductRequest;
use App\Http\Requests\User\Product\ProductListingRequest;
use App\Http\Requests\User\Product\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->middleware('jwt.auth')->except(['index', 'show']);
        // $this->middleware('role:user')->except(['index', 'show']);
    }

    /**
     * List all products
     *
     * @param ProductListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(ProductListingRequest $request)
    {
        $products = $this->productRepository->listAll($request->validated());
        return $this->success($products, 'Products fetched successfully');
    }

    /**
     * Create a new Product
     *
     * @param CreateProductRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->create($request->validated());
        return $this->success($product, 'Product created successfully');
    }

    /**
     * Show a product
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $product = $this->productRepository->fetch($uuid);
        return $this->success($product, 'Product fetched successfully');
    }

    /**
     * Update a product
     *
     * @param UpdateProductRequest $request
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function update(UpdateProductRequest $request, string $uuid)
    {
        $product = $this->productRepository->update($uuid, $request->validated());
        return $this->success($product, 'Product updated successfully');
    }

    /**
     * Delete a product
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function destroy(string $uuid)
    {
        $this->productRepository->delete($uuid);
        return $this->success(null, 'Product deleted successfully');
    }
}
