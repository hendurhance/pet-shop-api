<?php

namespace App\Http\Controllers\API\V1\User\Main;

use App\Contracts\Repositories\User\BlogRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Blog\BlogListingRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * BlogController constructor.
     */
    public function __construct(private BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * List all blogs
     *
     * @param BlogListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(BlogListingRequest $request)
    {
        $blogs = $this->blogRepository->listAll($request->validated());
        return $this->success($blogs, 'Blogs fetched successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show a blog
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $blog = $this->blogRepository->find($uuid);
        return $this->success($blog, 'Blog fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
