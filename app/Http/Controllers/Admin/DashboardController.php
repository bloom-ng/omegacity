<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data for the dashboard
        $stats = [
            'total_orders' => 1245,
            'total_products' => 89,
            'total_customers' => 342,
            'total_revenue' => '£' . number_format(45678.90, 2)
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
