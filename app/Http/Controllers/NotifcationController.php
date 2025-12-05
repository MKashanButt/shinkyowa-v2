<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotifcationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(8);

        return view('admin.notification.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();

        return redirect()->route('admin.notification.index')
            ->with('success', 'Notification marked as read successfully.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('admin.notification.index')
            ->with('success', 'Notification deleted successfully.');
    }
}
