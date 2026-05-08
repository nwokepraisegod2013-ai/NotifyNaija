<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\Notifications\Dispatcher\NotificationDispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Send notification (multi-channel)
     */
    public function send(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_id'  => 'required|integer',
            'title'    => 'required|string|max:255',
            'message'  => 'required|string',
            'channels' => 'required|array'
        ]);

        $notification = Notification::create($data);

        app(NotificationDispatcher::class)->send($data);

        return response()->json([
            'success' => true,
            'message' => 'Sent across multiple channels',
            'data'    => $notification
        ]);
    }

    /**
     * API: list notifications
     */
    public function index(): JsonResponse
    {
        $notifications = Notification::latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $notifications
        ]);
    }

    /**
     * API: single notification
     */
    public function show(int $id): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Notification::findOrFail($id)
        ]);
    }

    /**
     * WEB UI: dashboard page
     */
    public function indexPage()
    {
        $notifications = Notification::latest()->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * WEB UI: single page
     */
    public function showPage($id)
    {
        $notification = Notification::findOrFail($id);

        return view('notifications.show', compact('notification'));
    }
}