<?php

namespace App\Http\Controllers;

use App\Services\DashboardServices;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardServices $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getDashboard()
    {
        $dashboardData = $this->dashboardService->obtenerDashboardData();

        return response()->json($dashboardData);
    }
}
