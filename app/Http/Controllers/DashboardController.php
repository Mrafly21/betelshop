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
        $user = auth()->user();
        if ($user->role_as == 0) {
            return redirect('/')->with('error', 'Access Denied. You do not have permission to access the admin dashboard.');
        }
    
        $todayDate = Carbon::now()->format('Y-m-d');
        $timeNow = Carbon::now()->timezone('Asia/Jakarta')->format('H:i');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
    
        $totalProducts = $totalOrder = $todayOrder = $thisMonthOrder = $thisYearOrder = null;
    
        if ($user->role_as == 1) {
            $totalProducts = Product::count();
            $totalOrder = Order::count();
            $todayOrder = Order::whereDate('created_at', '=', $todayDate)->count();
            $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
            $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();
        } elseif ($user->role_as == 2) {
            $totalProducts = Product::where('user_id', $user->id)->count();
            $totalOrder = Order::where('seller_id', $user->id)->count();
            $todayOrder = Order::where('seller_id', $user->id)->whereDate('created_at', $todayDate)->count();
            $thisMonthOrder = Order::where('seller_id', $user->id)->whereMonth('created_at', $thisMonth)->count();
            $thisYearOrder = Order::where('seller_id', $user->id)->whereYear('created_at', $thisYear)->count();
        }
       
        $totalAllUser = User::count();
        $totalUser = User::where('role_as', '0')->count(); 
        $totalAdmin = User::where('role_as', '1')->count();
        
        $totalCategories = Category::count();

        return view('admin.index', compact('timeNow', 'totalProducts', 'totalCategories', 'totalAllUser', 'totalUser', 'totalAdmin', 'todayDate',
        'thisMonth', 'thisYear', 'totalOrder', 'todayOrder', 'thisMonthOrder', 'thisYearOrder'));
    }
    
}
