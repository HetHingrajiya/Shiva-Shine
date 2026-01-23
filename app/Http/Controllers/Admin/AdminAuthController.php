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

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $admin = Admin::where('email', $request->email)->first();

            if (!$admin) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Admin account not found'
                ], 401);
            }

            // Store session
            session(['admin_id' => $admin->id]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Login successful',
                'redirect'=> route('admin.dashboard')
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Database connection error
            \Log::error('Admin login database error: ' . $e->getMessage());
            
            return response()->json([
                'status'  => 'error',
                'message' => 'Database connection error. Please try again later.',
                'debug'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        } catch (\Exception $e) {
            // General error
            \Log::error('Admin login error: ' . $e->getMessage());
            
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again.',
                'debug'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function dashboard()
    {
        if (!session('admin_id')) {
            return redirect()->route('admin.login');
        }

        // 🟢 Fetch Live Data
        $totalCustomers = User::count();
        $ordersToday    = Order::whereDate('created_at', today())->count();
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
                               ->where('status', 'completed')
                               ->sum('total_amount');
        $profitMargin   = $monthlyRevenue > 0 ? round(($monthlyRevenue * 0.32), 2) : 0; // Example: 32%
        $newSignups     = User::whereDate('created_at', today())->count();
        $refunds        = Order::where('status', 'refunded')->sum('total_amount');
        $avgOrderValue  = Order::avg('total_amount');
        $conversionRate = 4.7; // You’ll need tracking for real rate
        $pendingOrders  = Order::where('status', 'pending')->count();
        $shippedOrders  = Order::where('status', 'shipped')->count();
        $activeProducts = Product::count();
        $websiteVisitors = 54320; // You’ll need analytics to track this

        // Sales Data
        $sales = [
            'online' => Order::where('payment_method', 'online')->sum('total_amount'),
            'cod'    => Order::where('payment_method', 'cod')->sum('total_amount'),
        ];

        // Traffic Sources (static unless you integrate analytics)
        $trafficSources = [
            ['label' => 'Organic Search', 'value' => '42%'],
            ['label' => 'Social Media', 'value' => '25%'],
            ['label' => 'Direct', 'value' => '18%'],
            ['label' => 'Referral', 'value' => '15%'],
        ];

        // Recent Activity (last 7 events)
        $activities = Order::latest()->take(7)->get()->map(function($order) {
            return [
                'color' => $order->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500',
                'text'  => "Order #{$order->order_code} - {$order->status}",
                'time'  => $order->created_at->diffForHumans(),
            ];
        });

        return view('admin.dashboard', compact(
            'totalCustomers',
            'ordersToday',
            'monthlyRevenue',
            'profitMargin',
            'newSignups',
            'refunds',
            'avgOrderValue',
            'conversionRate',
            'pendingOrders',
            'shippedOrders',
            'activeProducts',
            'websiteVisitors',
            'sales',
            'trafficSources',
            'activities'
        ));
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
