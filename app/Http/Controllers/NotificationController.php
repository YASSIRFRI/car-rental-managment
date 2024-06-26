<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->where('read', false)->get();
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }
}
