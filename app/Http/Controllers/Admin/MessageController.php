<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
    public function index(){
        $user = auth()->user(); 
        if ($user->role_as == 0) {
            return redirect('/')->with('error', 'Access Denied. You do not have permission to access the admin dashboard.');
        }
        if ($user->role_as == 2) {
            return redirect('/admin/dashboard')->with('error', 'Access Denied. You do not have permission to access the admin dashboard.');
        }
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.message.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message->status == 0) {
            $message->update(['status' => 1]);
        }
        return view('admin.message.details', compact('message'));
    }
}
