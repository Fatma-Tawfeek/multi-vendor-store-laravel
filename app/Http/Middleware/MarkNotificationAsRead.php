<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if ($request->has('notification_id')) {
        //     auth()->user()->notifications()
        //         ->where('id', $request->notification)
        //         ->update(['read_at' => now()]);
        // }
        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $user = auth()->user();
            if ($user) {
                $notification = $user->unreadNotifications()
                    ->where('id', $notification_id)->first();
                if ($notification) {
                    $notification->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
