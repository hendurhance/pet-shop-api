<?php

namespace App\Http\Controllers\API\V1\User\Main;

use App\Contracts\Repositories\User\PromotionRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Promotion\PromotionListingRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * PromotionController constructor.
     */
    public function __construct(private PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * List all promotions
     *
     * @param PromotionListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(PromotionListingRequest $request)
    {
        $promotions = $this->promotionRepository->listAll($request->validated());
        return $this->success($promotions, 'Promotions fetched successfully');
    }
}
