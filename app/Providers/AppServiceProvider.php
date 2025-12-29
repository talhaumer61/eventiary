<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {

                $notifications = Notification::where('user_id', Auth::id())
                    ->orderBy('created_at', 'DESC')
                    ->take(10)
                    ->get();

                $unreadCount = Notification::where('user_id', Auth::id())
                    ->where('is_read', 0)
                    ->count();

                $view->with([
                    'global_notifications' => $notifications,
                    'global_unread_count'  => $unreadCount,
                ]);
            }
        });
    }
}
