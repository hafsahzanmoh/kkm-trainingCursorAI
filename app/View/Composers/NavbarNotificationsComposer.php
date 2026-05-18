<?php

namespace App\View\Composers;

use Illuminate\View\View;

class NavbarNotificationsComposer
{
    /**
     * Bind unread notification data for the main layout navbar bell dropdown.
     */
    public function compose(View $view): void
    {
        if (! auth()->check()) {
            $view->with([
                'navbarUnreadNotifications' => collect(),
                'navbarUnreadCount' => 0,
            ]);

            return;
        }

        $user = auth()->user();

        $view->with([
            'navbarUnreadNotifications' => $user->unreadNotifications()->latest()->limit(10)->get(),
            'navbarUnreadCount' => $user->unreadNotifications()->count(),
        ]);
    }
}
