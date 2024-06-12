<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        // Mark notification as read
        if ($notification->status == 'unread') {
            $notification->status = 'read';
            $notification->save();
        }

        return view('frontend.notifications.show', compact('notification'));
    }
}

