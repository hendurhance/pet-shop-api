<?php

namespace App\Http\Controllers\API\V1\User\Category;

use App\Contracts\Repositories\User\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Category\CategoryListingRequest;
use App\Http\Requests\User\Category\CreateCategoryRequest;
use App\Http\Requests\User\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('jwt.auth')->except(['index', 'show']);
        $this->middleware('role:user')->except(['index', 'show']);
    }

    /**
     * List all categories
     *
     * @param CategoryListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(CategoryListingRequest $request)
    {
        $categories = $this->categoryRepository->listAll($request->validated());

        return $this->success($categories, 'Categories fetched successfully');
    }

    /**
     * Create a new category
     *
     * @param CreateCategoryRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->title);

        return $this->success($category, 'Category created successfully');
    }

    /**
     * Show a category
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $category = $this->categoryRepository->find($uuid);

        return $this->success($category, 'Category fetched successfully');
    }

    /**
     * Update category
     *
     * @param UpdateCategoryRequest $request
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function update(UpdateCategoryRequest $request, string $uuid)
    {
        $category = $this->categoryRepository->update($request->title, $uuid);

        return $this->success($category, 'Category updated successfully');
    }

    /**
     * Delete a category
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function destroy(string $uuid)
    {
        $this->categoryRepository->delete($uuid);

        return $this->success(null, 'Category deleted successfully');
    }
}
