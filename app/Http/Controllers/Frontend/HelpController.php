<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('frontend.help.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        $message = new Message;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

         // Send notification to the seller
         $users = User::where('role_as', 1)->get();
         foreach ($users as $user) {
             Notification::create([
                 'user_id' => $user->id,
                 'message' => 'New question received, please check the message dashboard',
                 'type' => 'new_question',
                 'status' => 'unread',
             ]);
            }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
