<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Example: Fetch some analytics data
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $revenue = Order::sum('total_amount'); // assuming your orders table has 'total_amount'

        return view('admin.analytics', compact(
            'totalUsers',
            'totalOrders',
            'totalProducts',
            'revenue'
        ));
    }
}
