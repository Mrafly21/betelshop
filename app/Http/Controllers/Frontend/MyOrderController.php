<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId);

        if ($request->date) {
            $orders->whereDate('created_at', $request->date);
        }

        if ($request->status) {
            $orders->where('status_message', $request->status);
        }

        $orders = $orders->paginate(30)->appends($request->except('page'));

        return view('frontend.pages.my-order', compact('orders'));
    }

    public function show(int $orderId)
    {
        $userId = auth()->id();
        $order = Order::where('id', $orderId)->where('user_id', $userId)->first();
        if ($order) {
            return view('frontend.pages.my-order-details', compact('order'));
        } else {
            return redirect('myorder')->with('message', 'Order ID not found or access denied');
        }
    }
}
