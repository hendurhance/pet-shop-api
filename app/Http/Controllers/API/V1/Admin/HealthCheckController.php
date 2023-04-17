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
    public function index()
    {
        return $this->success(['status' => 'ok'], 'Health check for admin api is ok');
    }
}
