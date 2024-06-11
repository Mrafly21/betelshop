<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestBecomeSeller;
use App\Models\User;
use App\Notifications\SellerRequestRejected;
use Illuminate\Http\Request;

class RequestBecomeSellerController extends Controller
{
    public function index(){
        $requestSellers = RequestBecomeSeller::all();
        return view('admin.request-become-seller.index', compact('requestSellers'));
    }

    public function accept($id)
    {
        $requestSeller = RequestBecomeSeller::findOrFail($id);
        $user = User::where('email', $requestSeller->email)->first();

        if ($user) {
            $user->update([
                'contact_number' => $requestSeller->contact_number,
                'role_as' => 2,
            ]);

            $requestSeller->delete();

            return redirect('admin/become-seller')->with('message', 'Request accepted and user role updated successfully.');
        } else {
            return redirect('admin/become-seller')->with('message', 'User not found.');
        }
    }

    public function reject($id)
    {
        $requestSeller = RequestBecomeSeller::findOrFail($id);
        $requestSeller->delete();

        return redirect('admin/become-seller')->with('message', 'Request rejected and deleted successfully.');
    }
}
