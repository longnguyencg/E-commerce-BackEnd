<?php


namespace App\Http\Controllers;


use App\Notification;

class NotificationController
{
    public function index()
    {
        return Notification::orderBy('id','DESC')->get();
    }

    public function add($order_id)
    {
        $notification = new Notification();
        $notification->order_id = $order_id;
        $notification->save();
    }

    public function seenAll()
    {
        $notifications = Notification::all();
        foreach ($notifications as $notification) {
            $notification->seen = 1;
            $notification->save();
        }
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
    }

    public function destroyAll()
    {
        $notifications = Notification::all();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
    }
}
