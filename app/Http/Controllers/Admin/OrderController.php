<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    if ($user->role_as == 0) {
        return redirect('/')->with('error', 'Access Denied. You do not have permission to access the admin dashboard.');
    }

    $orders = Order::query(); 
    if ($user->role_as == 2) {
        $orders->where('seller_id', $user->id);
    }
    if ($request->date) {
        $orders->whereDate('created_at', $request->date);
    }

    if ($request->status) {
        $orders->where('status_message', $request->status);
    }
    $orders = $orders->paginate(10);

    return view('admin.order.index', compact('orders'));
}


    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.order.show', compact('order'));
        } else {
            return redirect('admin/order')->with('message', 'Order ID not found');
        }
    }

    public function updateOrder(Request $request, int $orderId)
{
    $order = Order::findOrFail($orderId);
    $action = $request->input('action');
    if ($action === 'update_status') {
        $order->update([
            'status_message' => $request->update_status
        ]);
        return redirect('admin/order/'.$orderId)->with('message', 'Order Status Updated');
    } elseif ($action === 'update_details') {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pincode' => 'required|string|max:255',
            'address' => 'required|string',
            'payment' => 'required|string',
            'shipping' => 'required|string'
        ]);

        $order->update([
            'fullname' => $validatedData['fullname'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'pincode' => $validatedData['pincode'],
            'address' => $validatedData['address'],
            'payment_mode' => $validatedData['payment'],
            'tracking_no' => $validatedData['shipping'],
        ]);

        return redirect('admin/order/'.$orderId)->with('message', 'Order Details Updated');
    } else {
        return redirect('admin/order/'.$orderId)->with('error', 'Invalid action');
    }
}

    public function viewInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->download('invoice' . $orderId . '-' . $todayDate . '.pdf');

    }
}
