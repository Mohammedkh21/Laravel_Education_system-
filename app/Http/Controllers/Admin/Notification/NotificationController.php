<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Services\Admin\Notification\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(public  NotificationService $notificationService)
    {
    }

    function index()
    {
        return response()->json(
            $this->notificationService->getAll()
        );
    }

    function markAsRead()
    {
        return response()->json(
            $this->notificationService->markAsRead()
        );
    }
}
