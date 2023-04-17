<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    /**
     * Get health check
     * @return \App\Traits\HttpResponse
     */
    /**
     * @OA\Get(
     *    path="/api/v1/admin/health-check",
     *    tags={"Health Check"},
     *   summary="Get health check",
     *  description="Get health check",
     * @OA\Response(
     *       response=200,
     *      description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(
     *            property="status",
     *          type="string",
     *        example="ok"
     *     ),
     *   ),
     * ),
     * )
     */
    public function index()
    {
        return $this->success(['status' => 'ok'], 'Health check for admin api is ok');
    }
}
