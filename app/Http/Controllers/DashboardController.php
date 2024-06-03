<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $totalAllUser = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $timeNow = Carbon::now()->timezone('Asia/Jakarta')->format('H:i');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        return view('admin.index', compact('timeNow','totalProducts', 'totalCategories', 'totalAllUser', 'totalUser', 'totalAdmin', 'todayDate',
    'thisMonth', 'thisYear', 'totalOrder', 'todayOrder', 'thisMonthOrder', 'thisYearOrder'));
    }
}
