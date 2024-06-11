<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestBecomeSeller;

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

        return redirect('/')->with('message', 'Request to become a seller has been submitted successfully.');
    }
}
