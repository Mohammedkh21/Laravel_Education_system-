<?php

namespace App\Services\Notification;

class NotificationService
{

    function getAll()
    {
        return auth()->user()->unreadNotifications;
    }

    function markAsRead()
    {
        return auth()->user()->notifications->markAsRead();
    }
}
