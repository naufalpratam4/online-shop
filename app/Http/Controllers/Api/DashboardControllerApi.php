<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderAdmin;
use Illuminate\Http\Request;

class DashboardControllerApi extends Controller
{
    public function index()
    {
        $customers = OrderAdmin::all();
        return response()->json(['customers', $customers]);
    }
}
