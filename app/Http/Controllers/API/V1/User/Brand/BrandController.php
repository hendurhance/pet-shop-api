<?php

namespace App\Http\Controllers\API\V1\User\Brand;

use App\Contracts\Repositories\User\BrandRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Brand\BrandListingRequest;
use App\Http\Requests\User\Brand\CreateBrandRequest;
use App\Http\Requests\User\Brand\UpdateBrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * BrandController constructor.
     */
    public function __construct(private BrandRepositoryInterface $brandRepository)
    {
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('role:user')->except(['index', 'show']);
        $this->brandRepository = $brandRepository;
    }

    /**
     * List all brands
     *
     * @param BrandListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(BrandListingRequest $request)
    {
        $brands = $this->brandRepository->listAll($request->validated());
        return $this->success($brands, 'Brands fetched successfully');
    }

    /**
     * Create a new Brand
     *
     * @param CreateBrandRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreateBrandRequest $request)
    {
        $brand = $this->brandRepository->create($request->title);
        return $this->success($brand, 'Brand created successfully');
    }

    /**
     * Show a brand
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $brand = $this->brandRepository->fetch($uuid);
        return $this->success($brand, 'Brand fetched successfully');
    }

    /**
     * Update the brand.
     * @param UpdateBrandRequest $request
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function update(UpdateBrandRequest $request, string $uuid)
    {
        $brand = $this->brandRepository->update($uuid, $request->title);
        return $this->success($brand, 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $this->brandRepository->delete($uuid);
        return $this->success(null, 'Brand deleted successfully');
    }
}
