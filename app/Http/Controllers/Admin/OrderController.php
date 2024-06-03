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
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at', $todayDate)->paginate(5);

        // $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when(
            $request->date != null,
            function ($q) use ($request) {

                return $q->whereDate('created_at', $request->date);
            },
            // function ($q) use ($todayDate) {
            //     return $q->whereDate('created_at', $todayDate);
            // }
        )->when($request->status != null, function ($q) use ($request) {
            return $q->where('status_message', $request->status);
        })->paginate(10);
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
    // Find the order by ID
    $order = Order::findOrFail($orderId);

    // Check the action type
    $action = $request->input('action');

    // Perform the appropriate action based on the action type
    if ($action === 'update_status') {
        // Update order status
        $order->update([
            'status_message' => $request->update_status
        ]);
        return redirect('admin/order/'.$orderId)->with('message', 'Order Status Updated');
    } elseif ($action === 'update_details') {
        // Validate the incoming request data for updating details
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pincode' => 'required|string|max:255',
            'address' => 'required|string',
            'payment' => 'required|string',
            'shipping' => 'required|string'
            // Add validation rules for other fields
        ]);

        // Update the order details
        $order->update([
            'fullname' => $validatedData['fullname'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'pincode' => $validatedData['pincode'],
            'address' => $validatedData['address'],
            'payment_mode' => $validatedData['payment'],
            'tracking_no' => $validatedData['shipping'],
            // Update other fields as needed
        ]);

        // Redirect back to the order details page with a success message
        return redirect('admin/order/'.$orderId)->with('message', 'Order Details Updated');
    } else {
        // Invalid action
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
