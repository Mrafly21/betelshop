<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\RequestBecomeSeller;
use App\Models\User;

class RequestBecomeSellerController extends Controller
{
    public function index()
    {
        return view('frontend.pages.become-seller');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'contact_number' => 'required',
            'description' => 'required',
        ]);

        $existingRequest = RequestBecomeSeller::where('email', auth()->user()->email)->first();

        if ($existingRequest) {
            return redirect()->back()->with('message', 'Your request is still being processed. Wait until the process done. If your request rejected, you can submit the request again.');
        }

        RequestBecomeSeller::create([
            'user_name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
        ]);

         // Send notifications to users with role_as = 1
         $users = User::where('role_as', 1)->get();
         foreach ($users as $user) {
             Notification::create([
                 'user_id' => $user->id,
                 'message' => 'New Request Become a Seller from User, please check the "Request Become Seller" in Dashboard ',
                 'type' => 'new_request_become_seller',
                 'status' => 'unread',
             ]);
         }

        return redirect('/')->with('message', 'Request to become a seller has been submitted successfully.');
    }
}
