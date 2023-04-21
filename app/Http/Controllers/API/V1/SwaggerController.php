<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    /**
     * Get swagger
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('swagger.index');
    }
}
